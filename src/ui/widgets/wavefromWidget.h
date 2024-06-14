

#ifndef WAVEFROMWIDGET_H
#define WAVEFROMWIDGET_H

#include <QWidget>


namespace Ui{
    class wavefromWidget;
}

class wavefromWidget : public QWidget
{
    Q_OBJECT
private:
    /* data */
    Ui::wavefromWidget *ui;
public:
    wavefromWidget(QWidget *parent = nullptr);
    ~wavefromWidget();
};




#endif