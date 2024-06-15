cmake_minimum_required (VERSION 3.0)
cmake_policy(VERSION 3.0)  # 处理该项目的最低策略版本

# 如果支持，请为 MSVC 编译器启用热重载。
if (POLICY CMP0141)
  set(CMAKE_MSVC_DEBUG_INFORMATION_FORMAT "$<IF:$<AND:$<C_COMPILER_ID:MSVC>,$<CXX_COMPILER_ID:MSVC>>,$<$<CONFIG:Debug,RelWithDebInfo>:EditAndContinue>,$<$<CONFIG:Debug,RelWithDebInfo>:ProgramDatabase>>")
endif()

project (app)

set(NAME app)

set(CMAKE_CXX_STANDARD 17)
set(CMAKE_CXX_STANDARD_REQUIRED ON)  
set(CMAKE_CXX_EXTENSIONS ON)  

set(CMAKE_AUTOMOC ON)
set(CMAKE_AUTORCC ON)
set(CMAKE_AUTOUIC ON)
set(CMAKE_INCLUDE_CURRENT_DIR ON)

set(CMAKE_PREFIX_PATH "C:/Qt/6.5.1/msvc2019_64")


set(CMAKE_RUNTIME_OUTPUT_DIRECTORY ${CMAKE_SOURCE_DIR}/bin)

link_directories(${CMAKE_SOURCE_DIR}/lib)


find_package(QT NAMES Qt6 Qt5 REQUIRED COMPONMENTS Widgets)
message("Qt version ::: " ${QT_VERSION_MAJOR})
find_package(Qt${QT_VERSION_MAJOR} REQUIRED COMPONENTS 
									Widgets
									Gui
									Core
									OpenGL
									OpenGLWidgets)

# 查找 OpenGL 库
find_package(OpenGL REQUIRED)

# 添加资源文件
qt6_add_resources(RESOURCES src/resources.qrc)

file(GLOB SOURCE
	"src/ui/*.h"
	"src/ui/*.cpp"
	"src/ui/*.ui"
	"src/ui/widgets/*.h"
	"src/ui/widgets/*.cpp"
	"src/ui/widgets/*.ui"
	"src/ui/items/*.h"
	"src/ui/items/*.cpp"

	"public/process/*.h"
	"public/process/*.cpp"

	"src/*.cpp"

  )

# message(STATUS "============ source :: ${SOURCE}")

add_executable (${NAME} ${SOURCE} ${RESOURCES})



macro(makeLink src dest target)
   add_custom_command(TARGET ${target} POST_BUILD COMMAND ${CMAKE_COMMAND} -E create_symlink ${src} ${dest}  DEPENDS  ${dest} COMMENT "mklink ${src} -> ${dest}")
endmacro()




target_link_libraries(app PRIVATE Qt${QT_VERSION_MAJOR}::Widgets
								Qt${QT_VERSION_MAJOR}::Gui
								Qt${QT_VERSION_MAJOR}::Core
								Qt${QT_VERSION_MAJOR}::OpenGL
								Qt${QT_VERSION_MAJOR}::OpenGLWidgets
)

if(MSVC)
    target_compile_options(${NAME} PRIVATE /std:c++17 /MP)
    target_link_options(${NAME} PUBLIC /ignore:4099)
endif(MSVC)

if(WIN32)
    set_target_properties(${NAME} PROPERTIES RUNTIME_OUTPUT_DIRECTORY "${CMAKE_SOURCE_DIR}/bin")
    set_target_properties(${NAME} PROPERTIES VS_DEBUGGER_WORKING_DIRECTORY "${CMAKE_SOURCE_DIR}/bin/Debug")
endif(WIN32)


# copy dlls
file(GLOB DLLS "dlls/*.dll")
add_custom_command(TARGET ${NAME} PRE_BUILD COMMAND ${CMAKE_COMMAND} -E copy ${DLLS} $<TARGET_FILE_DIR:${NAME}>)

include_directories(${CMAKE_SOURCE_DIR}/includes)
include_directories(app PUBLIC
    ${CMAKE_CURRENT_SOURCE_DIR}/src
    )



# 链接 OpenGL 库
if(OPENGL_FOUND)
	message(STATUS "++++++++ ::  sss"${OPENGL_INCLUDE_DIRS})
	include_directories(${OPENGL_INCLUDE_DIR})
	target_link_libraries(app PRIVATE ${OPENGL_LIBRARIES})
else()
	message(STATUS "++++++ :: have not find opengl")
endif()



if (CMAKE_VERSION VERSION_GREATER 3.12)
  set_property(TARGET app PROPERTY CXX_STANDARD 17)
endif()

# TODO: 如有需要，请添加测试并安装目标。
