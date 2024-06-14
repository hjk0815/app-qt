#include "glWidget.h"
#include <iostream>


glWidget::glWidget(QWidget *parent)
    :  QOpenGLWidget(parent) 
{
}

glWidget::~glWidget()
{
}

void glWidget::initializeGL()
{
    std::cout << "enter inital gl..." << std::endl;
    // Set up the rendering context, load shaders and other resources, etc.:
    QOpenGLFunctions *f = QOpenGLContext::currentContext()->functions();
    f->glClearColor(0.30196, 0.30196, 0.30196, 0.5f);
}

void glWidget::resizeGL(int w, int h)
{
    // Update projection matrix and other size related settings:
    //m_projection.setToIdentity();
    //m_projection.perspective(45.0f, w / float(h), 0.01f, 100.0f);
}

void glWidget::paintGL()
{
    // Draw the scene:
    QOpenGLFunctions *f = QOpenGLContext::currentContext()->functions();
    f->glClear(GL_COLOR_BUFFER_BIT);
}
