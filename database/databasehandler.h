// databasehandler.h
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
