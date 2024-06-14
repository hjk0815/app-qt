
#ifndef OPENGLWINDOW
#define OPENGLWINDOW

#include <QtGui/QWindow>
#include <QtGui/QOpenGLFunctions>

#include <QOpenGLDebugLogger>


QT_BEGIN_NAMESPACE
class QOpenGLContext;
QT_END_NAMESPACE

class OpenGLWindow : public QWindow, protected QOpenGLFunctions // QWindow
{
    Q_OBJECT
public slots :
    /*! Redirects to slot requestUpdate(), which registers an UpdateRequest event 
        in the event loop to be issued with next VSync.
    */
    void renderLater();  

    void renderNow();
private slots :
	/*! Receives debug messages from QOpenGLDebugLogger */
	void onMessageLogged(const QOpenGLDebugMessage &msg);
     
private:
    QOpenGLDebugLogger	*m_debugLogger;
    void initOpenGL();
public:
    explicit OpenGLWindow(QWindow *parent = nullptr);
    ~OpenGLWindow();

protected :
    QOpenGLContext *m_context;
protected :
    bool event(QEvent *event) override;
    void exposeEvent(QExposeEvent *event) override;
    void resizeEvent(QResizeEvent *event) override;

    // code user to override
    virtual void initializeGL() = 0; // code user to override
    virtual void resizeGL(int width, int length) {Q_UNUSED(width) Q_UNUSED(length)}
    virtual void paintGL() = 0;
};

#endif