#include "accueil.h"
#include "ui_accueil.h"

Accueil::Accueil(QWidget *parent)
    : QWidget(parent), ui(new Ui::Form)  // Changé ici
{
    ui->setupUi(this);
}

Accueil::~Accueil()
{
    delete ui;
}
