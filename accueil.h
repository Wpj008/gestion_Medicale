#ifndef ACCUEIL_H
#define ACCUEIL_H

#include <QWidget>

namespace Ui {
class Form;  // Changé de Accueil à Form
}

class Accueil : public QWidget {
    Q_OBJECT
public:
    explicit Accueil(QWidget *parent = nullptr);
    ~Accueil();

private:
    Ui::Form *ui;  // Changé de Ui::Accueil à Ui::Form
};
#endif
