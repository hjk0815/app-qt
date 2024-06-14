

#ifndef SCENEVIEW_H
#define SCENEVIEW_H

#include <QMatrix4x4>
#include <QOpenGLTimeMonitor>
#include <QElapsedTimer>

#include "openglWindow.h"
#include "shaderProgram.h"
#include "keyboardMouseHandler.h"
#include "GridObject.h"
#include "Camera.h"

class sceneView : public OpenGLWindow
{
public:
    /// @brief 
    sceneView(/* args */);
    virtual ~sceneView() override;

protected :
    void initializeGL() override;
    void resizeGL(int width, int height) override;
    void paintGL() override;

	// Functions to handle key press and mouse press events, all the work is done in class KeyboardMouseHandler
	void keyPressEvent(QKeyEvent *event) override;
	void keyReleaseEvent(QKeyEvent *event) override;
	void mousePressEvent(QMouseEvent *event) override;
	void mouseReleaseEvent(QMouseEvent *event) override;
	void mouseMoveEvent(QMouseEvent *event) override;
	void wheelEvent(QWheelEvent *event) override;
    
private:
	/*! This function is called first thing in the paintGL() routine and
		processes input received so far and updates camera position.
	*/
	void processInput();
	/*! Tests, if any relevant input was received and registers a state change. */
	void checkInput();
	/*! Compines camera matrix and project matrix to form the world2view matrix. */
	void updateWorld2ViewMatrix();
private :
    keyboardMouseHandler m_kbMouseHandler;
    /* if set to true, an input event was revceived, which will be evaluated at next repaint. */
    bool m_inputEventRecv;

	/*! The projection matrix, updated whenever the viewport geometry changes (in resizeGL() ). */
	QMatrix4x4					m_projection;
	Transform3D					m_transform;	// world transformation matrix generator
	Camera						m_camera;		// Camera position, orientation and lens data
	QMatrix4x4					m_worldToView;	// cached world to view transformation matrix

	/*! All shader programs used in the scene. */
	QList<shaderProgram>		m_shaderPrograms; 

	GridObject					m_minorGridObject;
	GridObject					m_majorGridObject;

	QOpenGLTimeMonitor			m_gpuTimers;
	QElapsedTimer				m_cpuTimer;

};







#endif