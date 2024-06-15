#include "process.h"

#include <iostream>


HANDLE createProcess()
{
    STARTUPINFOA si;
    PROCESS_INFORMATION pi;

    // Initialize the STARTUPINFO structure
    ZeroMemory(&si, sizeof(si));
    si.cb = sizeof(si);
    ZeroMemory(&pi, sizeof(pi));

    // Create a new process

    char cmdLine[260] = "D:/WorkProgram/Learn/app-qt/bin/apache/bin/httpd.exe  -f D:/WorkProgram/Learn/app-qt/httpd.conf";
    if (!CreateProcessA(NULL,
        cmdLine,
        NULL,
        NULL,
        TRUE,
        CREATE_NEW_PROCESS_GROUP,
        NULL,
        NULL,
        &si,
        &pi)
    ) {
        std::cerr << "CreateProcess failed (" << GetLastError() << ").\n";
    }
    std::cout << "Child process started with PID: " << pi.dwProcessId << "\n";
    return pi.hProcess; // Return the process handle
}

void stopProcess(HANDLE hProcess)
{
    if (TerminateProcess(hProcess, 0)) {
        std::cout << "Child process terminated.\n";
    } else {
        std::cerr << "Failed to terminate child process (" << GetLastError() << ").\n";
    }
    CloseHandle(hProcess); // close handle
}
