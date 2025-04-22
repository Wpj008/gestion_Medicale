cmake_minimum_required(VERSION 3.5)

project(GestionDossiersMedicaux VERSION 0.1 LANGUAGES CXX)

set(CMAKE_AUTOUIC ON)
set(CMAKE_AUTOMOC ON)
set(CMAKE_AUTORCC ON)

set(CMAKE_CXX_STANDARD 17)
set(CMAKE_CXX_STANDARD_REQUIRED ON)

# Trouver Qt6 ou Qt5 avec les modules nécessaires
find_package(QT NAMES Qt6 Qt5 REQUIRED COMPONENTS Core Widgets Sql)
find_package(Qt${QT_VERSION_MAJOR} REQUIRED COMPONENTS Core Widgets Sql)

set(PROJECT_SOURCES
        main.cpp
        mainwindow.cpp
        mainwindow.h
        mainwindow.ui
        accueil.h
        accueil.cpp
        accueil.ui
        database/databasehandler.h
        database/databasehandler.cpp
)

if(${QT_VERSION_MAJOR} GREATER_EQUAL 6)
    qt_add_executable(GestionDossiersMedicaux
        MANUAL_FINALIZATION
        ${PROJECT_SOURCES}
    )
else()
    if(ANDROID)
        add_library(GestionDossiersMedicaux SHARED
            ${PROJECT_SOURCES}
        )
    else()
        add_executable(GestionDossiersMedicaux
            ${PROJECT_SOURCES}
        )
    endif()
endif()

# Lier les bibliothèques Qt nécessaires
target_link_libraries(GestionDossiersMedicaux PRIVATE
    Qt${QT_VERSION_MAJOR}::Core
    Qt${QT_VERSION_MAJOR}::Widgets
    Qt${QT_VERSION_MAJOR}::Sql
)
