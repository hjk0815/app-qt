#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
//#include <QWindow>
#include <QOpenGLFunctions>

#include "ui/widgets/glWidget.h"
#include "ui/widgets/wavefromWidget.h"
#include "ui/items/openglWindow.h"
#include "ui/items/sceneView.h"


QT_BEGIN_NAMESPACE
class QPainter;
class QOpenGLContext;
class QOpenGLPaintDevice;
QT_END_NAMESPACE

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

    // void render();
    // void render(QPainter* painter);
public slots:
    void onWeb();
private:
    void initSlotConnect() const;
    void initGLWidget();
    void initCentralWidgets();


private:
    Ui::MainWindow *ui;
    wavefromWidget * m_wavefWidget;
    glWidget* m_openglWidget;
    // OpenGLWindow* m_glWidget;
    sceneView* m_sceneView;

    QOpenGLContext* m_context = nullptr;
    QOpenGLPaintDevice* m_device = nullptr;
};

#endif // MAINWINDOW_H
