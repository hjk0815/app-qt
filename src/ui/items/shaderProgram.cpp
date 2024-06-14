#include "shaderProgram.h"

#include <QOpenGLShaderProgram>
#include <QDebug>

#include "OpenGLException.h"



shaderProgram::shaderProgram(const QString &vsFilePath, const QString &fsFilePath)
    : m_vsFilePath(vsFilePath)
    , m_fsFilePath(fsFilePath)
    , m_program(nullptr)
{
	
}

shaderProgram::~shaderProgram()
{
    delete m_program;
}

void shaderProgram::create()
{
	FUNCID(shaderProgram::create);
	Q_ASSERT(m_program == nullptr);

	// build and compile our shader program
	// ------------------------------------

	m_program = new QOpenGLShaderProgram();

	// read the shader programs from the resource
	if (!m_program->addShaderFromSourceFile(QOpenGLShader::Vertex, m_vsFilePath))
		throw OpenGLException(QString("Error compiling vertex shader %1:\n%2").arg(m_vsFilePath).arg(m_program->log()), FUNC_ID);

	if (!m_program->addShaderFromSourceFile(QOpenGLShader::Fragment, m_fsFilePath))
		throw OpenGLException(QString("Error compiling fragment shader %1:\n%2").arg(m_fsFilePath).arg(m_program->log()), FUNC_ID);

	if (!m_program->link())
		throw OpenGLException(QString("Shader linker error:\n%2").arg(m_program->log()), FUNC_ID);

	m_uniformIDs.clear();
	for (const QString & uniformName : m_uniformNames)
		m_uniformIDs.append( m_program->uniformLocation(uniformName));
}

void shaderProgram::destroy()
{
    delete m_program;
	m_program = nullptr;
}

void shaderProgram::bind()
{
    m_program->bind();
}
