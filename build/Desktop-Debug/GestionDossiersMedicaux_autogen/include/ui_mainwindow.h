/********************************************************************************
** Form generated from reading UI file 'mainwindow.ui'
**
** Created by: Qt User Interface Compiler version 6.6.2
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_MAINWINDOW_H
#define UI_MAINWINDOW_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QHBoxLayout>
#include <QtWidgets/QLabel>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QSpacerItem>
#include <QtWidgets/QStackedWidget>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_MainWindow
{
public:
    QWidget *centralwidget;
    QHBoxLayout *horizontalLayout;
    QWidget *conteneurMenu;
    QVBoxLayout *verticalLayout;
    QSpacerItem *verticalSpacer;
    QWidget *widget_2;
    QVBoxLayout *verticalLayout_2;
    QPushButton *btnAccueil;
    QPushButton *btnGestionDossiers;
    QPushButton *btnProfil;
    QPushButton *btnAide;
    QSpacerItem *verticalSpacer_2;
    QStackedWidget *fenetrePrincipal;
    QWidget *dash_page;
    QVBoxLayout *verticalLayout_4;
    QLabel *label_2;
    QWidget *profil_page;
    QHBoxLayout *horizontalLayout_2;
    QLabel *label_4;
    QWidget *help_page;
    QVBoxLayout *verticalLayout_5;
    QLabel *label_3;
    QWidget *accueil_page;
    QVBoxLayout *verticalLayout_3;
    QLabel *label;
    QMenuBar *menubar;
    QStatusBar *statusbar;

    void setupUi(QMainWindow *MainWindow)
    {
        if (MainWindow->objectName().isEmpty())
            MainWindow->setObjectName("MainWindow");
        MainWindow->resize(800, 600);
        MainWindow->setStyleSheet(QString::fromUtf8(""));
        centralwidget = new QWidget(MainWindow);
        centralwidget->setObjectName("centralwidget");
        horizontalLayout = new QHBoxLayout(centralwidget);
        horizontalLayout->setObjectName("horizontalLayout");
        conteneurMenu = new QWidget(centralwidget);
        conteneurMenu->setObjectName("conteneurMenu");
        conteneurMenu->setMinimumSize(QSize(150, 0));
        conteneurMenu->setStyleSheet(QString::fromUtf8("#conteneurMenu{\n"
"	border-right:1px solid;\n"
"}"));
        verticalLayout = new QVBoxLayout(conteneurMenu);
        verticalLayout->setObjectName("verticalLayout");
        verticalSpacer = new QSpacerItem(20, 40, QSizePolicy::Policy::Minimum, QSizePolicy::Policy::Expanding);

        verticalLayout->addItem(verticalSpacer);

        widget_2 = new QWidget(conteneurMenu);
        widget_2->setObjectName("widget_2");
        widget_2->setStyleSheet(QString::fromUtf8(""));
        verticalLayout_2 = new QVBoxLayout(widget_2);
        verticalLayout_2->setObjectName("verticalLayout_2");
        btnAccueil = new QPushButton(widget_2);
        btnAccueil->setObjectName("btnAccueil");

        verticalLayout_2->addWidget(btnAccueil);

        btnGestionDossiers = new QPushButton(widget_2);
        btnGestionDossiers->setObjectName("btnGestionDossiers");

        verticalLayout_2->addWidget(btnGestionDossiers);

        btnProfil = new QPushButton(widget_2);
        btnProfil->setObjectName("btnProfil");

        verticalLayout_2->addWidget(btnProfil);

        btnAide = new QPushButton(widget_2);
        btnAide->setObjectName("btnAide");

        verticalLayout_2->addWidget(btnAide);


        verticalLayout->addWidget(widget_2);

        verticalSpacer_2 = new QSpacerItem(20, 40, QSizePolicy::Policy::Minimum, QSizePolicy::Policy::Expanding);

        verticalLayout->addItem(verticalSpacer_2);


        horizontalLayout->addWidget(conteneurMenu);

        fenetrePrincipal = new QStackedWidget(centralwidget);
        fenetrePrincipal->setObjectName("fenetrePrincipal");
        dash_page = new QWidget();
        dash_page->setObjectName("dash_page");
        verticalLayout_4 = new QVBoxLayout(dash_page);
        verticalLayout_4->setObjectName("verticalLayout_4");
        label_2 = new QLabel(dash_page);
        label_2->setObjectName("label_2");
        label_2->setAlignment(Qt::AlignHCenter|Qt::AlignTop);

        verticalLayout_4->addWidget(label_2);

        fenetrePrincipal->addWidget(dash_page);
        profil_page = new QWidget();
        profil_page->setObjectName("profil_page");
        horizontalLayout_2 = new QHBoxLayout(profil_page);
        horizontalLayout_2->setObjectName("horizontalLayout_2");
        label_4 = new QLabel(profil_page);
        label_4->setObjectName("label_4");
        label_4->setAlignment(Qt::AlignHCenter|Qt::AlignTop);

        horizontalLayout_2->addWidget(label_4);

        fenetrePrincipal->addWidget(profil_page);
        help_page = new QWidget();
        help_page->setObjectName("help_page");
        verticalLayout_5 = new QVBoxLayout(help_page);
        verticalLayout_5->setObjectName("verticalLayout_5");
        label_3 = new QLabel(help_page);
        label_3->setObjectName("label_3");
        label_3->setAlignment(Qt::AlignHCenter|Qt::AlignTop);

        verticalLayout_5->addWidget(label_3);

        fenetrePrincipal->addWidget(help_page);
        accueil_page = new QWidget();
        accueil_page->setObjectName("accueil_page");
        verticalLayout_3 = new QVBoxLayout(accueil_page);
        verticalLayout_3->setObjectName("verticalLayout_3");
        label = new QLabel(accueil_page);
        label->setObjectName("label");
        label->setAlignment(Qt::AlignHCenter|Qt::AlignTop);

        verticalLayout_3->addWidget(label);

        fenetrePrincipal->addWidget(accueil_page);

        horizontalLayout->addWidget(fenetrePrincipal);

        MainWindow->setCentralWidget(centralwidget);
        menubar = new QMenuBar(MainWindow);
        menubar->setObjectName("menubar");
        menubar->setGeometry(QRect(0, 0, 800, 23));
        MainWindow->setMenuBar(menubar);
        statusbar = new QStatusBar(MainWindow);
        statusbar->setObjectName("statusbar");
        MainWindow->setStatusBar(statusbar);

        retranslateUi(MainWindow);

        QMetaObject::connectSlotsByName(MainWindow);
    } // setupUi

    void retranslateUi(QMainWindow *MainWindow)
    {
        MainWindow->setWindowTitle(QCoreApplication::translate("MainWindow", "GESTION DOSSIERS MEDICAUX", nullptr));
        btnAccueil->setText(QCoreApplication::translate("MainWindow", "accueil", nullptr));
        btnGestionDossiers->setText(QCoreApplication::translate("MainWindow", "gestion dossiers", nullptr));
        btnProfil->setText(QCoreApplication::translate("MainWindow", "profil hosto", nullptr));
        btnAide->setText(QCoreApplication::translate("MainWindow", "aide", nullptr));
        label_2->setText(QCoreApplication::translate("MainWindow", "Gestion des Dossiers (Dashboard)", nullptr));
        label_4->setText(QCoreApplication::translate("MainWindow", " Prodil de l'hosto et de l'admin", nullptr));
        label_3->setText(QCoreApplication::translate("MainWindow", "aide", nullptr));
        label->setText(QCoreApplication::translate("MainWindow", "Page Accueil", nullptr));
    } // retranslateUi

};

namespace Ui {
    class MainWindow: public Ui_MainWindow {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_MAINWINDOW_H
