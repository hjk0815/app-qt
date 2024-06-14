#include "wavefromWidget.h"
#include "ui_wavefromWidget.h"



wavefromWidget::wavefromWidget(QWidget *parent)
    : ui(new Ui::wavefromWidget)
{
    ui->setupUi(this);
}

wavefromWidget::~wavefromWidget()
{
    delete ui;
}
