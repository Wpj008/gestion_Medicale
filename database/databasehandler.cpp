#include "databasehandler.h"

DatabaseHandler::DatabaseHandler() {
    m_db = QSqlDatabase::addDatabase("QSQLITE");
    m_db.setDatabaseName("gestionMedicale.db"); // Le fichier sera créé à la racine du projet
}

DatabaseHandler& DatabaseHandler::instance() {
    static DatabaseHandler instance;
    return instance;
}

bool DatabaseHandler::openDatabase() {
    if (!m_db.open()) {
        qCritical() << "Échec de la connexion à la base de données:" << m_db.lastError().text();
        return false;
    }
    return true;
}

void DatabaseHandler::closeDatabase() {
    if (m_db.isOpen())
        m_db.close();
}

bool DatabaseHandler::initializeDatabase() {
    if (!openDatabase())
        return false;

    QSqlQuery query;

    QStringList creationQueries = {
        R"(
        CREATE TABLE IF NOT EXISTS patients (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            postnom TEXT,
            prenom TEXT NOT NULL,
            date_naissance DATE NOT NULL,
            lieu_naissance TEXT,
            sexe TEXT CHECK(sexe IN ('Masculin', 'Féminin')),
            etat_civil TEXT,
            adresse TEXT,
            profession TEXT
        ))",

        R"(
        CREATE TABLE IF NOT EXISTS employes (
            matricule TEXT PRIMARY KEY,
            nom TEXT NOT NULL,
            postnom TEXT,
            prenom TEXT NOT NULL,
            date_naissance DATE,
            lieu_naissance TEXT,
            sexe TEXT CHECK(sexe IN ('Masculin', 'Féminin')),
            etat_civil TEXT,
            adresse TEXT,
            fonction TEXT CHECK(fonction IN ('Médecin', 'Infirmier', 'Administrateur', 'Réceptionniste')),
            service TEXT
        ))",

        R"(
        CREATE TABLE IF NOT EXISTS consultations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            id_medecin TEXT NOT NULL,
            id_patient INTEGER NOT NULL,
            maladie TEXT,
            date_consultation DATE NOT NULL,
            symptome TEXT,
            diagnostic TEXT,
            plainte TEXT,
            prescription TEXT,
            email TEXT NOT NULL UNIQUE,
            mot_de_passe TEXT NOT NULL,
            FOREIGN KEY(id_medecin) REFERENCES employes(matricule),
            FOREIGN KEY(id_patient) REFERENCES patients(id)
        ))",

        R"(
        CREATE TABLE IF NOT EXISTS paiements (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            id_patient INTEGER NOT NULL,
            montant REAL NOT NULL,
            date_paiement DATE NOT NULL,
            mode_paiement TEXT CHECK(mode_paiement IN ('Espèces', 'Carte bancaire')),
            FOREIGN KEY(id_patient) REFERENCES patients(id)
        ))",

        R"(
        CREATE TABLE IF NOT EXISTS historique (
            id_historique INTEGER PRIMARY KEY AUTOINCREMENT,
            id_employe TEXT NOT NULL,
            description TEXT NOT NULL,
            date_action DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY(id_employe) REFERENCES employes(matricule)
        ))"
    };

    for (const QString &sql : creationQueries) {
        if (!query.exec(sql)) {
            qWarning() << "Erreur de création de table:" << query.lastError().text();
            return false;
        }
    }

    qDebug() << "Base de données initialisée avec succès.";
    return true;
}

// Fonction de mise à jour d'enregistrement (ex: mot de passe)
bool DatabaseHandler::updateRecord(const QString &table, const QVariantMap &data, const QString &condition) {
    if (!m_db.isOpen()) {
        qWarning() << "Base de données non ouverte.";
        return false;
    }

    QStringList setClauses;
    QVariantList values;
    for (auto it = data.begin(); it != data.end(); ++it) {
        setClauses.append(it.key() + " = ?");
        values.append(it.value());
    }

    QString queryStr = QString("UPDATE %1 SET %2 WHERE %3").arg(table).arg(setClauses.join(", ")).arg(condition);
    QSqlQuery query(m_db);
    query.prepare(queryStr);

    for (int i = 0; i < values.size(); ++i) {
        query.addBindValue(values[i]);
    }

    if (!query.exec()) {
        qWarning() << "Erreur lors de la mise à jour :" << query.lastError();
        return false;
    }

    return true;
}

// Fonction de génération de matricule unique
QString DatabaseHandler::generateUniqueMatricule(const QString &fonction) {
    QString prefix;

    if (fonction == "Médecin") {
        prefix = "MED";
    } else if (fonction == "Infirmier") {
        prefix = "INF";
    } else if (fonction == "Administrateur") {
        prefix = "ADM";
    } else if (fonction == "Réceptionniste") {
        prefix = "REC";
    } else {
        qWarning() << "Fonction inconnue, impossible de générer un matricule.";
        return QString();
    }

    QSqlQuery query(m_db);
    query.prepare("SELECT COUNT(*) FROM employes WHERE fonction = :fonction");
    query.bindValue(":fonction", fonction);

    if (!query.exec() || !query.next()) {
        qWarning() << "Erreur lors de la récupération du nombre d'employés :" << query.lastError();
        return QString();
    }

    int count = query.value(0).toInt() + 1;
    QString matricule = QString("%1%2").arg(prefix).arg(count, 4, 10, QChar('0')); // Ex: MED0001

    return matricule;
}

// Fonction d'ajout d'un employé (champs de base uniquement pour l’instant)
bool DatabaseHandler::ajouterEmploye(const QString& nom, const QString& postnom, const QString& prenom, const QString& fonction) {
    QString matricule = generateUniqueMatricule(fonction);
    if (matricule.isEmpty()) {
        return false;
    }

    QSqlQuery query(m_db);
    query.prepare("INSERT INTO employes (matricule, nom, postnom, prenom, fonction) "
                  "VALUES (:matricule, :nom, :postnom, :prenom, :fonction)");
    query.bindValue(":matricule", matricule);
    query.bindValue(":nom", nom);
    query.bindValue(":postnom", postnom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":fonction", fonction);

    if (!query.exec()) {
        qWarning() << "Erreur lors de l'ajout de l'employé:" << query.lastError();
        return false;
    }

    qDebug() << "Employé ajouté avec matricule:" << matricule;
    return true;
}











/*
#include "databasehandler.h"
#include <QSqlRecord>
#include <QCoreApplication>
DatabaseHandler::DatabaseHandler(QObject *parent) : QObject(parent)
{
    // Chemin relatif au dossier du projet
    QString dbPath = QCoreApplication::applicationDirPath() + "/database";

    // Crée le sous-dossier si nécessaire
    QDir dir(dbPath);
    if (!dir.exists()) {
        dir.mkpath(".");
    }

    // Chemin complet du fichier DB
    QString dbFile = dbPath + "/gestiondossiersmed.db";
    qDebug() << "Database path:" << dbFile;  // Affiche le chemin pour vérification

    // Configuration de la base de données
    m_db = QSqlDatabase::addDatabase("QSQLITE");
    m_db.setDatabaseName(dbFile);

}

DatabaseHandler::~DatabaseHandler()
{
    if (m_db.isOpen()) {
        m_db.close();
    }
}

DatabaseHandler& DatabaseHandler::instance()
{
    static DatabaseHandler instance;
    return instance;
}

bool DatabaseHandler::initializeDatabase()
{
    if (!m_db.open()) {
        qCritical() << "Cannot open database:" << m_db.lastError();
        return false;
    }

    return createTables();
}

bool DatabaseHandler::createTables()
{
    QSqlQuery query;

    // Table utilisateurs
    if (!query.exec("CREATE TABLE IF NOT EXISTS users ("
                    "id INTEGER PRIMARY KEY AUTOINCREMENT, "
                    "username TEXT UNIQUE NOT NULL, "
                    "password TEXT NOT NULL, "
                    "email TEXT, "
                    "created_at DATETIME DEFAULT CURRENT_TIMESTAMP)")) {
        qCritical() << "Error creating users table:" << query.lastError();
        return false;
    }

    // Table produits
    if (!query.exec("CREATE TABLE IF NOT EXISTS products ("
                    "id INTEGER PRIMARY KEY AUTOINCREMENT, "
                    "name TEXT NOT NULL, "
                    "description TEXT, "
                    "price REAL NOT NULL, "
                    "quantity INTEGER DEFAULT 0, "
                    "created_at DATETIME DEFAULT CURRENT_TIMESTAMP)")) {
        qCritical() << "Error creating products table:" << query.lastError();
        return false;
    }

    // Table commandes
    if (!query.exec("CREATE TABLE IF NOT EXISTS orders ("
                    "id INTEGER PRIMARY KEY AUTOINCREMENT, "
                    "user_id INTEGER NOT NULL, "
                    "product_id INTEGER NOT NULL, "
                    "quantity INTEGER NOT NULL, "
                    "total_price REAL NOT NULL, "
                    "order_date DATETIME DEFAULT CURRENT_TIMESTAMP, "
                    "FOREIGN KEY(user_id) REFERENCES users(id), "
                    "FOREIGN KEY(product_id) REFERENCES products(id))")) {
        qCritical() << "Error creating orders table:" << query.lastError();
        return false;
    }

    return true;
}

QSqlDatabase DatabaseHandler::database() const
{
    return m_db;
}

bool DatabaseHandler::addRecord(const QString &table, const QVariantMap &data)
{
    if (table.isEmpty() || data.isEmpty()) return false;

    QStringList fields = data.keys();
    QStringList placeholders;

    for (int i = 0; i < fields.size(); ++i) {
        placeholders.append("?");
    }

    QSqlQuery query;
    query.prepare(QString("INSERT INTO %1 (%2) VALUES (%3)")
                      .arg(table)
                      .arg(fields.join(", "))
                      .arg(placeholders.join(", ")));

    foreach (const QString &field, fields) {
        query.addBindValue(data.value(field));
    }

    if (!query.exec()) {
        qWarning() << "Add record error:" << query.lastError();
        return false;
    }

    return true;
}

bool DatabaseHandler::updateRecord(const QString &table, const QVariantMap &data, const QString &where)
{
    if (table.isEmpty() || data.isEmpty()) return false;

    QStringList updates;
    QStringList fields = data.keys();

    foreach (const QString &field, fields) {
        updates.append(QString("%1 = ?").arg(field));
    }

    QSqlQuery query;
    query.prepare(QString("UPDATE %1 SET %2 WHERE %3")
                      .arg(table)
                      .arg(updates.join(", "))
                      .arg(where));

    foreach (const QString &field, fields) {
        query.addBindValue(data.value(field));
    }

    if (!query.exec()) {
        qWarning() << "Update record error:" << query.lastError();
        return false;
    }

    return true;
}

bool DatabaseHandler::deleteRecord(const QString &table, const QString &where)
{
    if (table.isEmpty() || where.isEmpty()) return false;

    QSqlQuery query;
    query.prepare(QString("DELETE FROM %1 WHERE %2").arg(table).arg(where));

    if (!query.exec()) {
        qWarning() << "Delete record error:" << query.lastError();
        return false;
    }

    return true;
}

QList<QVariantMap> DatabaseHandler::getRecords(const QString &table, const QString &where, const QString &orderBy)
{
    QList<QVariantMap> records;

    QString queryStr = QString("SELECT * FROM %1").arg(table);

    if (!where.isEmpty()) {
        queryStr += " WHERE " + where;
    }

    if (!orderBy.isEmpty()) {
        queryStr += " ORDER BY " + orderBy;
    }

    QSqlQuery query(queryStr);

    if (!query.exec()) {
        qWarning() << "Get records error:" << query.lastError();
        return records;
    }

    while (query.next()) {
        QVariantMap record;
        for (int i = 0; i < query.record().count(); ++i) {
            record.insert(query.record().fieldName(i), query.value(i));
        }
        records.append(record);
    }

    return records;
}

QVariantMap DatabaseHandler::getRecord(const QString &table, const QString &where)
{
    QVariantMap record;

    if (table.isEmpty() || where.isEmpty()) return record;

    QSqlQuery query;
    query.prepare(QString("SELECT * FROM %1 WHERE %2 LIMIT 1").arg(table).arg(where));

    if (!query.exec()) {
        qWarning() << "Get record error:" << query.lastError();
        return record;
    }

    if (query.next()) {
        for (int i = 0; i < query.record().count(); ++i) {
            record.insert(query.record().fieldName(i), query.value(i));
        }
    }

    return record;
}
*/
