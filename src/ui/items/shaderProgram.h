

#ifndef SHADERPROGRAM_H
#define SHADERPROGRAM_H

#include <QString>
#include <QStringList>

#include <QOpenGLShaderProgram>

QT_BEGIN_NAMESPACE
class QOpenGLShaderProgram;
QT_END_NAMESPACE

class shaderProgram
{
private:
	/*! The wrapped native QOpenGLShaderProgram. */
	QOpenGLShaderProgram	*m_program;
public:
	/*! Path to vertex shader program, used in create(). */
	QString		m_vsFilePath;
	/*! Path to fragment shader program, used in create(). */
	QString		m_fsFilePath;

	/*! List of uniform values to be resolved. Values is used in create(). */
	QStringList	m_uniformNames;

	/*! Holds uniform Ids to be used in conjunction with setUniformValue(). */
	QList<int>	m_uniformIDs;

public:
    //shaderProgram(/* args */);
    shaderProgram(const QString& vsFilePath,const QString& fsFilePath);
    ~shaderProgram();

	/*! Creates shader program, compiles and links the programs. */
	void create();

	/*! Destroys OpenGL resources, OpenGL context must be made current before this function is callded! */
	void destroy();

    void bind();

	/*! Access to the native shader program. */
	QOpenGLShaderProgram * getShaderProgram() { return m_program; }
};


#endif