// databasehandler.cpp
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
