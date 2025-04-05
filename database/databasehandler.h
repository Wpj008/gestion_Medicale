#ifndef DATABASEHANDLER_H
#define DATABASEHANDLER_H

#include <QObject>
#include <QSqlDatabase>
#include <QSqlQuery>
#include <QSqlError>
#include <QVariantMap>
#include <QDebug>

class DatabaseHandler : public QObject
{
    Q_OBJECT
public:
    explicit DatabaseHandler(QObject *parent = nullptr);
    ~DatabaseHandler();

    static DatabaseHandler& instance();

    bool initializeDatabase();
    bool openDatabase();     // ajout manquant
    void closeDatabase();    // ajout manquant

    bool updateRecord(const QString &table, const QVariantMap &data, const QString &condition);
    QString generateUniqueMatricule(const QString &fonction);
    bool ajouterEmploye(const QString &nom, const QString &postnom, const QString &prenom, const QString &fonction); // ajout manquant

private:
    QSqlDatabase m_db;
};

#endif // DATABASEHANDLER_H























































/*
#ifndef DATABASEHANDLER_H
#define DATABASEHANDLER_H
#include <QObject>
#include <QSqlDatabase>
#include <QSqlQuery>
#include <QSqlError>
#include <QDebug>
#include <QStandardPaths>
#include <QDir>

class DatabaseHandler : public QObject
{
    Q_OBJECT

public:
    static DatabaseHandler& instance();

    bool initializeDatabase();
    QSqlDatabase database() const;

    // Fonctions CRUD
    bool addRecord(const QString &table, const QVariantMap &data);
    bool updateRecord(const QString &table, const QVariantMap &data, const QString &where);
    bool deleteRecord(const QString &table, const QString &where);
    QList<QVariantMap> getRecords(const QString &table, const QString &where = "", const QString &orderBy = "");
    QVariantMap getRecord(const QString &table, const QString &where);

private:
    explicit DatabaseHandler(QObject *parent = nullptr);
    ~DatabaseHandler();
    DatabaseHandler(const DatabaseHandler&) = delete;
    DatabaseHandler& operator=(const DatabaseHandler&) = delete;

    bool createTables();
    QSqlDatabase m_db;
};

#endif // DATABASEHANDLER_H
*/
