#include "mainwindow.h"
#include "./ui_mainwindow.h"
#include "accueil.h"
MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent),
    ui(new Ui::MainWindow),
    page_accueil(new Accueil(this))
{
    ui->setupUi(this);

    // Ajout de la page d'accueil au stacked widget
    ui->fenetrePrincipal->insertWidget(0, page_accueil);

    // Définir la page d'accueil comme page active (index 0)
    ui->fenetrePrincipal->setCurrentIndex(0);  // <-- Cette ligne est cruciale

    // Connexions des boutons
    connect(ui->btnAccueil, &QPushButton::clicked, [this](){
        changePage(0);
    });
    connect(ui->btnGestionDossiers, &QPushButton::clicked, [this](){
        changePage(1);
    });
    connect(ui->btnProfil, &QPushButton::clicked, [this](){
        changePage(2);
    });
    connect(ui->btnAide, &QPushButton::clicked, [this](){
        changePage(3);
    });
}
MainWindow::~MainWindow()
{
    delete page_accueil;
    delete ui;
}

void MainWindow::changePage(int index)
{
    ui->fenetrePrincipal->setCurrentIndex(index);
}
