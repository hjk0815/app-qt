

#include <iostream>
#include <QtWidgets/QApplication>
#include <QDateTime>

#include "ui/mainwindow.h"
using namespace std;



void qDebugMsgHandler(QtMsgType type, const QMessageLogContext &context, const QString &msg) {
	(void) context;
	QString msgPrefix = "[" + QDateTime::currentDateTime().toString() + "] ";
	switch (type) {
		case QtDebugMsg		: msgPrefix += "Debug:    "; break;
		case QtWarningMsg	: msgPrefix += "Warning:  "; break;
		case QtCriticalMsg	: msgPrefix += "Critical: "; break;
		case QtFatalMsg		: msgPrefix += "Fatal:    "; break;
		case QtInfoMsg		: msgPrefix += "Info:     "; break;
	}
	QStringList lines = msg.split("\n");
	for (const QString & l : lines)
		std::cout << (msgPrefix + l).toStdString() << std::endl;
}


int main(int argc, char* argv[])
{
	qInstallMessageHandler(qDebugMsgHandler);
	qDebug() << "Debug message";
	qInfo() << "Info message";
	cout << "Hello CMake." << endl;
	int err = 0;
	argc = 1;
	argv[2] = { 0 };
	argv[0] = (char*)"app";

	QApplication app(argc, argv);

	MainWindow w;
	w.show();
	err = app.exec();

	getchar();
	return err;
}
