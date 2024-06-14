#include "openglWindow.h"


OpenGLWindow::OpenGLWindow(QWindow *parent)
    : QWindow(parent)
	, m_context(nullptr)
	, m_debugLogger(nullptr)
{
	setSurfaceType(QWindow::OpenGLSurface);
}

OpenGLWindow::~OpenGLWindow()
{
}

void OpenGLWindow::renderLater() {
	// Schedule an UpdateRequest event in the event loop
	// that will be send with the next VSync.
	requestUpdate(); // call public slot requestUpdate()
}

void OpenGLWindow::renderNow() {
	if (!isExposed())
		return;

	// initialize on first call
	if (m_context == nullptr)
		initOpenGL();

	m_context->makeCurrent(this);

	paintGL(); // call user code

	m_context->swapBuffers(this);
}


// *** protect function ***
bool OpenGLWindow::event(QEvent *event)
{
    switch (event->type())
    {
    case QEvent::UpdateRequest:
        renderNow();
        return true;
    default:
        return QWindow::event(event);
    }
}

void OpenGLWindow::exposeEvent(QExposeEvent *event)
{
    //	qDebug() << "OpenGLWindow::exposeEvent()";
	renderNow(); // update right now

	// Note: if were just to request an update on next sync, i.e. by
	//       calling renderLater() (or requestUpdate()) we get
	//       white glitches when enlarging the window. Since we don't want that,
	//       we simply render right away so that the new window size
	//       is already reflected by the adjusted viewport we render into.
}

void OpenGLWindow::resizeEvent(QResizeEvent * event)
{//	qDebug() << "OpenGLWindow::resizeEvent()";
	QWindow::resizeEvent(event);

	// initialize on first call
	if (m_context == nullptr)
		initOpenGL();

	resizeGL(width(), height());
}

void OpenGLWindow::initOpenGL()
{
    Q_ASSERT(m_context == nullptr);
    m_context = new QOpenGLContext(this);
    m_context->setFormat(requestedFormat());
    m_context->create();

	m_context->makeCurrent(this);
	Q_ASSERT(m_context->isValid());

    initializeOpenGLFunctions();

    initializeGL(); // call user code
}


void OpenGLWindow::onMessageLogged(const QOpenGLDebugMessage &msg) {
	QString prefix;

	// Format based on severity
	switch (msg.severity()) {
		case QOpenGLDebugMessage::NotificationSeverity:
			prefix += "++++";
		break;
		case QOpenGLDebugMessage::HighSeverity:
			prefix += "+++";
		break;
		case QOpenGLDebugMessage::MediumSeverity:
			prefix += "++";
		break;
		case QOpenGLDebugMessage::LowSeverity:
			prefix += "+";
		break;
	}

	prefix += " [";

	// Format based on source
#define CASE(c) case QOpenGLDebugMessage::c: prefix += #c; break
	switch (msg.source())
	{
	  CASE(APISource);
	  CASE(WindowSystemSource);
	  CASE(ShaderCompilerSource);
	  CASE(ThirdPartySource);
	  CASE(ApplicationSource);
	  CASE(OtherSource);
	  CASE(InvalidSource);
	}
 #undef CASE

	prefix += ":";

	// Format based on type
 #define CASE(c) case QOpenGLDebugMessage::c: prefix += #c; break
	switch (msg.type())
	{
		CASE(ErrorType);
		CASE(DeprecatedBehaviorType);
		CASE(UndefinedBehaviorType);
		CASE(PortabilityType);
		CASE(PerformanceType);
		CASE(OtherType);
		CASE(MarkerType);
		CASE(GroupPushType);
		CASE(GroupPopType);
	}
#undef CASE

	prefix += "] ";
	qDebug().noquote().nospace() << prefix << msg.message() << "\n";

}