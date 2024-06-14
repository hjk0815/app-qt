#include "keyboardMouseHandler.h"
#include <QKeyEvent>
#include <QMouseEvent>
#include <QWheelEvent>

keyboardMouseHandler::keyboardMouseHandler()
    : m_leftButton(StateNotPressed)
    , m_middleButton(StateNotPressed)
    , m_rightButton(StateNotPressed)
    , m_wheelDelta(0)
{   
}

keyboardMouseHandler::~keyboardMouseHandler()
{
}

void keyboardMouseHandler::addRecognizedKey(Qt::Key k)
{
    if (std::find(m_keys.begin(), m_keys.end(), k) != m_keys.end())
		return; // already known
	// remember key to be known and expected
	m_keys.push_back(k);
	m_keyStates.push_back(StateNotPressed);
}

void keyboardMouseHandler::clearRecognizedKeys()
{
    m_keys.clear();
	m_keyStates.clear();
}

void keyboardMouseHandler::keyPressEvent(QKeyEvent *event)
{
    if (event->isAutoRepeat()) {
		event->ignore();
	}
	else {
		pressKey(static_cast<Qt::Key>((event->key())));
	}
}

void keyboardMouseHandler::keyReleaseEvent(QKeyEvent *event)
{
	if (event->isAutoRepeat())	{ /*检查键盘事件是否是自动重复生成的。
                                    自动重复的键盘事件是指当按住一个键不放时，系统会自动生成多个按键按下和释放事件。*/ 
		event->ignore();
	}
	else {
		releaseKey(static_cast<Qt::Key>((event->key())));
	}
}

void keyboardMouseHandler::mousePressEvent(QMouseEvent *event)
{
    pressButton(static_cast<Qt::MouseButton>(event->button()), event->globalPos());
}

void keyboardMouseHandler::mouseReleaseEvent(QMouseEvent *event)
{
    releaseButton(static_cast<Qt::MouseButton>(event->button()), event->globalPos());
}

void keyboardMouseHandler::wheelEvent(QWheelEvent *event)
{
	QPoint numPixels = event->pixelDelta();
	QPoint numDegrees = event->angleDelta() / 8;

	if (!numPixels.isNull()) {
		m_wheelDelta += numPixels.y();
	} else if (!numDegrees.isNull()) {
		QPoint numSteps = numDegrees / 15;
		m_wheelDelta += numSteps.y();
	}

	event->accept();
}

bool keyboardMouseHandler::pressButton(Qt::MouseButton btn, QPoint currentPos)
{
    switch (btn)    
    {
    case Qt::LeftButton : m_leftButton = StateHeld; break;
    case Qt::MiddleButton : m_middleButton = StateHeld; break;
    case Qt::RightButton : m_rightButton = StateHeld; break;
    default: return false;
    }
    m_mouseDownPos = currentPos;
    return true;
}

bool keyboardMouseHandler::releaseButton(Qt::MouseButton btn, QPoint currentPos)
{
    switch (btn)    
    {
    case Qt::LeftButton : m_leftButton = StateWasPressed; break;
    case Qt::MiddleButton : m_middleButton = StateWasPressed; break;
    case Qt::RightButton : m_rightButton = StateWasPressed; break;
    default: return false;
    }
    m_mouseReleasePos = currentPos;
    return true;
}

bool keyboardMouseHandler::keyDown(Qt::Key k) const
{
	for (unsigned int i=0; i<m_keys.size(); ++i) {
		if (m_keys[i] == k)
			return m_keyStates[i] == StateHeld;
	}
	return false;
}

bool keyboardMouseHandler::buttonDown(Qt::MouseButton btn) const
{
    switch (btn)    
    {
    case Qt::LeftButton   : return m_leftButton   == StateHeld; 
    case Qt::MiddleButton : return m_middleButton == StateHeld; 
    case Qt::RightButton  : return m_rightButton  == StateHeld; 
    default: return false;
    }
}

bool keyboardMouseHandler::buttonReleased(Qt::MouseButton btn) const
{
    switch (btn)    
    {
    case Qt::LeftButton   : return m_leftButton   == StateWasPressed; 
    case Qt::MiddleButton : return m_middleButton == StateWasPressed; 
    case Qt::RightButton  : return m_rightButton  == StateWasPressed; 
    default: return false;
    }
}

QPoint keyboardMouseHandler::resetMouseDelta(const QPoint currentPos)
{
	QPoint dist = currentPos - m_mouseDownPos;
	m_mouseDownPos = currentPos;
	return dist;
}

int keyboardMouseHandler::wheelDelta() const
{
    return m_wheelDelta;
}

int keyboardMouseHandler::resetWheelDelta()
{
	int wd = m_wheelDelta;
	m_wheelDelta = 0;
	return wd;
}

void keyboardMouseHandler::clearWasPressedKeyStates()
{
	m_leftButton = (m_leftButton == StateWasPressed) ? StateNotPressed  : m_leftButton;
	m_middleButton = (m_middleButton == StateWasPressed) ? StateNotPressed  : m_middleButton;
	m_rightButton = (m_rightButton == StateWasPressed) ? StateNotPressed  : m_rightButton;

	for (unsigned int i=0; i<m_keyStates.size(); ++i)
		m_keyStates[i] = static_cast<KeyStates>(m_keyStates[i] & 1); // toggle "WasPressed" bit -> NotPressed

}

bool keyboardMouseHandler::pressKey(Qt::Key k)
{
	for (unsigned int i=0; i<m_keys.size(); ++i) {
		if (m_keys[i] == k) {
			m_keyStates[i] = StateHeld;
			return true;
		}
	}
	return false;
}

bool keyboardMouseHandler::releaseKey(Qt::Key k)
{
	for (unsigned int i=0; i<m_keys.size(); ++i) {
		if (m_keys[i] == k) {
			m_keyStates[i] = StateWasPressed;
			return true;
		}
	}
	return false;
}
