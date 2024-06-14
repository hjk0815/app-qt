
#ifndef KEYBOARDMOUSEHANDLER_H
#define KEYBOARDMOUSEHANDLER_H

#include <iostream>
#include <vector>
#include <QPoint>


class QKeyEvent;
class QMouseEvent;
class QWheelEvent;


class keyboardMouseHandler
{
private :
    enum KeyStates {
        StateNotPressed,
        StateHeld,
        StateWasPressed,
    } ;

    KeyStates m_leftButton;
    KeyStates m_middleButton;
    KeyStates m_rightButton;

    int m_wheelDelta;

    QPoint m_mouseDownPos;
    QPoint m_mouseReleasePos;

    std::vector<Qt::Key> m_keys;
    std::vector<KeyStates> m_keyStates;
public:
    keyboardMouseHandler(/* args */);
    virtual ~keyboardMouseHandler();

	/*! Call this function for each key we are listening to. */
	void addRecognizedKey(Qt::Key k);
	/*! Clears list of recognized keys. */
	void clearRecognizedKeys();

	// Functions to handle key press and mouse press events
	// These function return true, if a recognized key/mouse button was pressed and
	// the scene may need to be updated.
	void keyPressEvent(QKeyEvent *event);
    void keyReleaseEvent(QKeyEvent *event);
    void mousePressEvent(QMouseEvent *event);
    void mouseReleaseEvent(QMouseEvent *event);
    void wheelEvent(QWheelEvent *event);

    /*! Called when a key was pressed. */
	bool pressKey(Qt::Key k);
    bool releaseKey(Qt::Key k);

	/*! Called when a mousebutton was pressed. */
	bool pressButton(Qt::MouseButton btn, QPoint currentPos);
	/*! Called when a mousebutton was released. */
	bool releaseButton(Qt::MouseButton btn, QPoint currentPos);

	/*! Returns, whether the key is pressed or was pressed in last query interval. */
	bool keyDown(Qt::Key k) const;
	/*! Returns, whether the mouse button is pressed or was pressed in last query interval. */
	bool buttonDown(Qt::MouseButton btn) const;
	/*! Returns, whether the mouse button was pressed and is now released. */
	bool buttonReleased(Qt::MouseButton btn) const;

    /*! Returns the position (global pos) that was recorded, when a mouse button was pressed.
		Use this function to determine whether the mouse has been moved (by comparing it to the QCursor::pos()).
	*/
	QPoint mouseDownPos() const { return m_mouseDownPos; }
    QPoint mouseReleasePos() const { return m_mouseReleasePos; }

	/*! Returns the difference between last and current mouse position and *updates*
		last mouse position to currentPos.
		The retrieved point (x and y distances) should be used to modify state based transformations.
	*/
	QPoint resetMouseDelta(const QPoint currentPos);
    
	/*! Retrieves the wheel distance (angle in degree) that was added up so far.
		Use this function to query, if the mouse wheel had been turned.
	*/
	int wheelDelta() const;

	/*! Retrieves the wheel distance (angle in degree) that was added up in the last query interval
		and resets it to zero.
	*/
	int resetWheelDelta();

	/*! This resets all key states currently marked as "WasPressed". */
	void clearWasPressedKeyStates();
};





#endif