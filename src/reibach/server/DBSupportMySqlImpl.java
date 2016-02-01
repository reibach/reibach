/**********************************************************************
 * $Revision: 1.11 $
 * $Date: 2010/11/02 12:02:19 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn software & services
 * All rights reserved
 *
 **********************************************************************/

package reibach.server;

import java.io.File;
import java.rmi.RemoteException;
import java.sql.Connection;
import java.text.MessageFormat;

import reibach.REIBACH;
import reibach.rmi.REIBACHDBService;
import de.willuhn.jameica.system.Application;
import de.willuhn.util.I18N;

/**
 * Implementierung des Datenbank-Supports fuer MySQL.
 */
public class DBSupportMySqlImpl extends AbstractDBSupportImpl
{
  /**
   * @see reibach.rmi.DBSupport#getJdbcDriver()
   */
  public String getJdbcDriver()
  {
    return REIBACHDBService.SETTINGS.getString("database.driver.mysql.jdbcdriver","com.mysql.jdbc.Driver");
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcPassword()
   */
  public String getJdbcPassword()
  {
    return REIBACHDBService.SETTINGS.getString("database.driver.mysql.password",null);
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcUrl()
   */
  public String getJdbcUrl()
  {
    return REIBACHDBService.SETTINGS.getString("database.driver.mysql.jdbcurl","jdbc:mysql://localhost:3306/reibach?useUnicode=Yes&characterEncoding=ISO8859_1");
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcUsername()
   */
  public String getJdbcUsername()
  {
    return REIBACHDBService.SETTINGS.getString("database.driver.mysql.username","reibach");
  }

  /**
   * Ueberschrieben, weil SQL-Scripts bei MySQL nicht automatisch durchgefuehrt werden.
   * Andernfalls wuerde jeder reibach-Client beim ersten Start versuchen, diese anzulegen.
   * Das soll der Admin sicherheitshalber manuell durchfuehren. Wir hinterlassen stattdessen
   * nur einen Hinweistext mit den auszufuehrenden SQL-Scripts.
   * @see reibach.server.AbstractDBSupportImpl#execute(java.sql.Connection, java.io.File)
   */
  public void execute(Connection conn, File sqlScript) throws RemoteException
  {
    if (sqlScript == null)
      return; // Ignore

    File f = new File(sqlScript.getParent(),getScriptPrefix() + sqlScript.getName());
    if (f.exists())
    {
      I18N i18n = Application.getPluginLoader().getPlugin(REIBACH.class).getResources().getI18N();
      
      String text = i18n.tr("Bei der Verwendung von MySQL wird die Datenbank " +
          "nicht automatisch angelegt. Bitte f�hren Sie das folgende SQL-Script " +
          "manuell aus, falls Sie dies nicht bereits getan haben:\n{0}",f.getAbsolutePath());
      Application.addWelcomeMessage(text);
    }
  }

  /**
   * @see reibach.rmi.DBSupport#getScriptPrefix()
   */
  public String getScriptPrefix() throws RemoteException
  {
    return "mysql-";
  }

  /**
   * @see reibach.rmi.DBSupport#getSQLTimestamp(java.lang.String)
   */
  public String getSQLTimestamp(String content) throws RemoteException
  {
    return MessageFormat.format("(UNIX_TIMESTAMP({0})*1000)", new Object[]{content});
  }

  /**
   * @see reibach.rmi.DBSupport#getInsertWithID()
   */
  public boolean getInsertWithID() throws RemoteException
  {
    return false;
  }

  /**
   * @see reibach.server.AbstractDBSupportImpl#getTransactionIsolationLevel()
   */
  public int getTransactionIsolationLevel() throws RemoteException
  {
    // damit sehen wir Datenbank-Updates durch andere
    // ohne vorher ein COMMIT machen zu muessen
    // Insbesondere bei MySQL sinnvoll.
    return Connection.TRANSACTION_READ_COMMITTED;
  }

}

