#include "sceneView.h"

#include "OpenGLException.h"

#define SHADER(x) m_shaderPrograms[x].getShaderProgram()


sceneView::sceneView()
    : m_inputEventRecv(false)
{
    // tell keyboard handler to monitor certain keys
	m_kbMouseHandler.addRecognizedKey(Qt::Key_W);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_A);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_S);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_D);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_Q);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_E);
	m_kbMouseHandler.addRecognizedKey(Qt::Key_Shift);

    // *** create scene (no OpenGL calls are being issued below, just the data structures are created.
	shaderProgram grid(":/ui/items/shaders/grid.vert",":/ui/items/shaders/grid.frag");
	grid.m_uniformNames.append("worldToView"); // mat4
	grid.m_uniformNames.append("gridColor"); // vec3
	grid.m_uniformNames.append("backColor"); // vec3
    m_shaderPrograms.append( grid );

    // *** initialize camera placement and model placement in the world

	// move camera a little back (mind: positive z) and look straight ahead
	m_camera.translate(0,17,50);
	// look slightly down
	m_camera.rotate(-5, m_camera.right());
	// look slightly left
	m_camera.rotate(-10, QVector3D(0.0f, 1.0f, 0.0f));
}

sceneView::~sceneView()
{
	if (m_context) {
		m_context->makeCurrent(this);

		for (shaderProgram & p : m_shaderPrograms)
			p.destroy();

		m_minorGridObject.destroy();
		m_majorGridObject.destroy();

		m_gpuTimers.destroy();
	}
}

void sceneView::initializeGL()
{
	FUNCID(sceneView::initializeGL);
	try {
		// initialize shader programs
		for (shaderProgram & p : m_shaderPrograms)
			p.create();

		// tell OpenGL to show only faces whose normal vector points towards us
		glEnable(GL_CULL_FACE);
		// enable depth testing, important for the grid and for the drawing order of several objects
		glEnable(GL_DEPTH_TEST);

		// initialize drawable objects
		m_minorGridObject.create(SHADER(0), false);
		m_majorGridObject.create(SHADER(0), true);

		// Timer
		m_gpuTimers.setSampleCount(3);
		m_gpuTimers.create();
	}
	catch (OpenGLException & ex) {
		throw OpenGLException(ex, "OpenGL initialization failed.", FUNC_ID);
	}

}

void sceneView::resizeGL(int width, int height)
{
	// the projection matrix need to be updated only for window size changes
	m_projection.setToIdentity();
	// create projection matrix, i.e. camera lens
	m_projection.perspective(
				/* vertical angle */ 45.0f,
				/* aspect ratio */   width / float(height),
				/* near */           0.1f,
				/* far */            10000.0f
		);
	// Mind: to not use 0.0 for near plane, otherwise depth buffering and depth testing won't work!

	// update cached world2view matrix
	updateWorld2ViewMatrix();
}

void sceneView::paintGL()
{
	m_cpuTimer.start();
	// if (((DebugApplication *)qApp)->m_aboutToTerminate)
	// 	return;

	// process input, i.e. check if any keys have been pressed
	if (m_inputEventRecv)
		processInput();

	const qreal retinaScale = devicePixelRatio(); // needed for Macs with retina display
	glViewport(0, 0, width() * retinaScale, height() * retinaScale);
	qDebug() << "SceneView::paintGL(): Rendering to:" << width() << "x" << height();

	// set the background color = clear color
	glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

	// set the background color = clear color
	QVector3D backColor(0.1f, 0.15f, 0.3f);
	glClearColor(0.1f, 0.15f, 0.3f, 1.0f);

	QVector3D minorGridColor(0.5f, 0.5f, 0.7f);
	QVector3D majorGridColor(0.8f, 0.8f, 1.0f);

	m_gpuTimers.reset();

	// *** render grid ***

	m_gpuTimers.recordSample(); // render minor grid
	SHADER(0)->bind();
	SHADER(0)->setUniformValue(m_shaderPrograms[0].m_uniformIDs[0], m_worldToView);
	SHADER(0)->setUniformValue(m_shaderPrograms[0].m_uniformIDs[1], minorGridColor);
	SHADER(0)->setUniformValue(m_shaderPrograms[0].m_uniformIDs[2], backColor);

	m_minorGridObject.render();

	m_gpuTimers.recordSample(); // render major grid
	SHADER(0)->setUniformValue(m_shaderPrograms[0].m_uniformIDs[1], majorGridColor);
	m_majorGridObject.render();
	SHADER(0)->release();

	m_gpuTimers.recordSample(); // done painting


#if 0
	// do some animation stuff
	m_transform.rotate(1.0f, QVector3D(0.0f, 0.1f, 0.0f));
	updateWorld2ViewMatrix();
	renderLater();
#endif

	checkInput();

	QVector<GLuint64> intervals = m_gpuTimers.waitForIntervals();
	for (GLuint64 it : intervals)
		qDebug() << "  " << it*1e-6 << "ms/frame";
	QVector<GLuint64> samples = m_gpuTimers.waitForSamples();
	qDebug() << "Total render time: " << (samples.back() - samples.front())*1e-6 << "ms/frame";

	qint64 elapsedMs = m_cpuTimer.elapsed();
	qDebug() << "Total paintGL time: " << elapsedMs << "ms";

}

void sceneView::keyPressEvent(QKeyEvent *event)
{
	m_kbMouseHandler.keyPressEvent(event);
	checkInput();
}

void sceneView::keyReleaseEvent(QKeyEvent *event)
{
	m_kbMouseHandler.keyReleaseEvent(event);
	checkInput();
}

void sceneView::mousePressEvent(QMouseEvent *event)
{
	m_kbMouseHandler.mousePressEvent(event);
	checkInput();
}

void sceneView::mouseReleaseEvent(QMouseEvent *event)
{
	m_kbMouseHandler.mouseReleaseEvent(event);
	checkInput();
}

void sceneView::mouseMoveEvent(QMouseEvent *event)
{
    checkInput();
}

void sceneView::wheelEvent(QWheelEvent *event)
{
	m_kbMouseHandler.wheelEvent(event);
	checkInput();
}

void sceneView::processInput()
{
	// function must only be called if an input event has been received
	Q_ASSERT(m_inputEventRecv);
	m_inputEventRecv = false;
//	qDebug() << "SceneView::processInput()";

	// check for trigger key
	// if (m_kbMouseHandler.buttonDown(Qt::RightButton)) {

	// Handle translations
	QVector3D translation;
	if (m_kbMouseHandler.keyDown(Qt::Key_W)) 		translation += m_camera.forward();
	if (m_kbMouseHandler.keyDown(Qt::Key_S)) 		translation -= m_camera.forward();
	if (m_kbMouseHandler.keyDown(Qt::Key_A)) 		translation -= m_camera.right();
	if (m_kbMouseHandler.keyDown(Qt::Key_D)) 		translation += m_camera.right();
	if (m_kbMouseHandler.keyDown(Qt::Key_Q)) 		translation -= m_camera.up();
	if (m_kbMouseHandler.keyDown(Qt::Key_E)) 		translation += m_camera.up();

	float transSpeed = 0.8f;
	if (m_kbMouseHandler.keyDown(Qt::Key_Shift))
		transSpeed = 0.1f;
	qDebug() << "translation :: " << translation;
	m_camera.translate(transSpeed * translation);

	// Handle rotations
	// get and reset mouse delta (pass current mouse cursor position)
	if (m_kbMouseHandler.buttonDown(Qt::LeftButton)){
		QPoint mouseDelta = m_kbMouseHandler.resetMouseDelta(QCursor::pos()); // resets the internal position
		static const float rotatationSpeed  = 0.4f;
		const QVector3D LocalUp(0.0f, 1.0f, 0.0f); // same as in Camera::up()
		m_camera.rotate(-rotatationSpeed * mouseDelta.x(), LocalUp);
		m_camera.rotate(-rotatationSpeed * mouseDelta.y(), m_camera.right());
	}

	// }
	int wheelDelta = m_kbMouseHandler.resetWheelDelta();
	if (wheelDelta != 0) {
		float transSpeed = 8.f;
		if (m_kbMouseHandler.keyDown(Qt::Key_Shift))
			transSpeed = 0.8f;
		m_camera.translate(wheelDelta * transSpeed * m_camera.forward());
	}

	// check for picking operation
	if (m_kbMouseHandler.buttonDown(Qt::MiddleButton)) {
		//pick(m_kbMouseHandler.mouseReleasePos());
		QPoint mouseDelta = m_kbMouseHandler.resetMouseDelta(QCursor::pos()); 
		qDebug() << "middle button :: " << mouseDelta ;
		translation.setX(mouseDelta.x());
		translation.setY(mouseDelta.y());
		translation.setZ(0);
		m_camera.translate(transSpeed * translation);
		
	}

	// finally, reset "WasPressed" key states
	m_kbMouseHandler.clearWasPressedKeyStates();

	updateWorld2ViewMatrix();
	// not need to request update here, since we are called from paint anyway

}

void sceneView::checkInput()
{
	// this function is called whenever _any_ key/mouse event was issued

	// we test, if the current state of the key handler requires a scene update
	// (camera movement) and if so, we just set a flag to do that upon next repaint
	// and we schedule a repaint

	// trigger key held?
	//if (m_kbMouseHandler.buttonDown(Qt::RightButton)) {
	// any of the interesting keys held?
	if (m_kbMouseHandler.keyDown(Qt::Key_W) ||
		m_kbMouseHandler.keyDown(Qt::Key_A) ||
		m_kbMouseHandler.keyDown(Qt::Key_S) ||
		m_kbMouseHandler.keyDown(Qt::Key_D) ||
		m_kbMouseHandler.keyDown(Qt::Key_Q) ||
		m_kbMouseHandler.keyDown(Qt::Key_E))
	{
		m_inputEventRecv = true;
//			qDebug() << "SceneView::checkInput() inputEventReceived";
		renderLater();
		return;
	}

	// has the mouse been moved?
	if (m_kbMouseHandler.buttonDown(Qt::LeftButton)) {
		if (m_kbMouseHandler.mouseDownPos() != QCursor::pos()) {
			m_inputEventRecv = true;
	//			qDebug() << "SceneView::checkInput() inputEventReceived: " << QCursor::pos() << m_kbMouseHandler.mouseDownPos();
			renderLater();
			return;
		}
	}
	// has the middle mouse butten been release
	if (m_kbMouseHandler.buttonDown(Qt::MiddleButton)) {
		if (m_kbMouseHandler.mouseDownPos() != QCursor::pos()) {
			m_inputEventRecv = true;
			// qDebug() << "SceneView::checkInput() middle inputEventReceived: " << QCursor::pos() << m_kbMouseHandler.mouseDownPos();
			renderLater();
			return;
		}
	}

	// scroll-wheel turned?
	if (m_kbMouseHandler.wheelDelta() != 0) {
		m_inputEventRecv = true;
		renderLater();
		return;
	}

	
}

void sceneView::updateWorld2ViewMatrix()
{
	// transformation steps:
	//   model space -> transform -> world space
	//   world space -> camera/eye -> camera view
	//   camera view -> projection -> normalized device coordinates (NDC)
	m_worldToView = m_projection * m_camera.toMatrix() * m_transform.toMatrix();
}
