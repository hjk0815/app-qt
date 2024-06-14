

#ifndef GLWIDGET_H
#define GLWIDGET_H

#include <QOpenGLWidget>
#include <QOpenGLFunctions>

class glWidget : public QOpenGLWidget, protected QOpenGLFunctions
{
private:
    /* data */
public:
    explicit glWidget(QWidget *parent); // 
    ~glWidget();

protected:
     void initializeGL() override;
     void resizeGL(int w, int h) override;
     void paintGL() override;

};



#endif
