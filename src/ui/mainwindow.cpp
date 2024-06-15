#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <iostream>
#include <QDesktopServices>
#include <qurl.h>

#include <QOpenGLContext>
#include <QOpenGLPaintDevice>
#include <QPainter>





MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
    , m_wavefWidget(new wavefromWidget)
    , m_openglWidget(new glWidget(this))
    , m_sceneView(new sceneView)
{
    ui->setupUi(this);
	QSurfaceFormat format;
	format.setRenderableType(QSurfaceFormat::OpenGL);
	format.setProfile(QSurfaceFormat::CoreProfile);
	format.setVersion(3,3);
	format.setSamples(4);	// enable multisampling (antialiasing)		// DISCUSS
	format.setDepthBufferSize(24);
    m_sceneView->setFormat(format);
    initCentralWidgets();
    initSlotConnect();
    initGLWidget();
    startHttpdServer();

}

MainWindow::~MainWindow()
{
    stopProcess(m_httpdHandle);
    std::cout << "destory MainWindow" << std::endl;
    delete ui;
    delete m_wavefWidget;
    delete m_device;
}

void MainWindow::initCentralWidgets()
{
    // ui->tabWidget_central->addTab(m_openglWidget,"3D");
    QWidget *container = QWidget::createWindowContainer(m_sceneView);
    container->setFocus();
 //   container->setFocusPolicy(Qt::TabFocus);
	//container->setMinimumSize(QSize(640,400));
    ui->tabWidget_central->addTab(container,"3D_2");
    ui->tabWidget_central->addTab(m_wavefWidget,"wavefrom");
}
void MainWindow::startHttpdServer()
{
    m_httpdHandle = createProcess();
    std::cout << "m_httpdHandle :: " << m_httpdHandle << std::endl;;
}
// void MainWindow::render()
// {
//     if (!m_device)
//         m_device = new QOpenGLPaintDevice;

//     //glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT | GL_STENCIL_BUFFER_BIT);

//     m_device->setSize(size() * devicePixelRatio());
//     m_device->setDevicePixelRatio(devicePixelRatio());

//     QPainter painter(m_device);
//     render(&painter);
// }

// void MainWindow::render(QPainter* painter)
// {
//     Q_UNUSED(painter);
// }

void MainWindow::onWeb()
{
    //std::cout << "test";
    std::string index;

    std::cout << "open url..." << std::endl;
}

void MainWindow::initSlotConnect() const
{
    connect(ui->actionweb, &QAction::triggered, this, &MainWindow::onWeb);
}

void MainWindow::initGLWidget()
{

}







