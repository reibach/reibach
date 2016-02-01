/**********************************************************************
 * $Revision: 1.12 $
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

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.lang.reflect.Method;
import java.rmi.RemoteException;
import java.security.SecureRandom;
import java.sql.Connection;
import java.util.Date;

import reibach.REIBACH;
import reibach.rmi.REIBACHDBService;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.Base64;

/**
 * Implementierung des Datenbank-Supports fuer H2-Database (http://www.h2database.com).
 */
public class DBSupportH2Impl extends AbstractDBSupportImpl
{
  /**
   * ct.
   */
  public DBSupportH2Impl()
  {
    // H2-Datenbank verwendet uppercase Identifier
    Logger.info("switching dbservice to uppercase");
    System.setProperty(REIBACHDBServiceImpl.class.getName() + ".uppercase","true");
    
    try
    {
      Method m = Application.getClassLoader().load("org.h2.engine.Constants").getMethod("getVersion",(Class[]) null);
      Logger.info("h2 version: " + m.invoke(null,(Object[])null));
    }
    catch (Throwable t)
    {
      Logger.warn("unable to determine h2 version");
    }
  }
  
  /**
   * @see reibach.rmi.DBSupport#getJdbcDriver()
   */
  public String getJdbcDriver()
  {
    return "org.h2.Driver";
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcPassword()
   */
  public String getJdbcPassword()
  {
    String password = REIBACHDBService.SETTINGS.getString("database.driver.h2.encryption.encryptedpassword",null);
    try
    {
      // Existiert noch nicht. Also neu erstellen.
      if (password == null)
      {
        // Wir koennen als Passwort nicht so einfach das Masterpasswort
        // nehmen, weil der User es aendern kann. Wir koennen zwar
        // das Passwort der Datenbank aendern. Allerdings kriegen wir
        // hier nicht mit, wenn sich das Passwort geaendert hat.
        // Daher erzeugen wir ein selbst ein Passwort.
        Logger.info("generating new random password for database");
        byte[] data = new byte[8];
        SecureRandom random = SecureRandom.getInstance("SHA1PRNG");
        random.setSeed((long) (new Date().getTime()));
        random.nextBytes(data);
        
        // Jetzt noch verschluesselt abspeichern
        Logger.info("encrypting password with system certificate");
        ByteArrayOutputStream bos = new ByteArrayOutputStream();
        Application.getSSLFactory().encrypt(new ByteArrayInputStream(data),bos);

        // Verschluesseltes Passwort als Base64 speichern
        REIBACHDBService.SETTINGS.setAttribute("database.driver.h2.encryption.encryptedpassword",Base64.encode(bos.toByteArray()));
        
        // Entschluesseltes Passwort als Base64 zurueckliefern, damit keine Binaer-Daten drin sind.
        // Die Datenbank will es doppelt mit Leerzeichen getrennt haben.
        // Das erste ist fuer den User. Das zweite fuer die Verschluesselung.
        String encoded = Base64.encode(data);
        return encoded + " " + encoded;
      }

      Logger.debug("decrypting database password");
      ByteArrayOutputStream bos = new ByteArrayOutputStream();
      Application.getSSLFactory().decrypt(new ByteArrayInputStream(Base64.decode(password)),bos);
      
      String encoded = Base64.encode(bos.toByteArray());
      return encoded + " " + encoded;
    }
    catch (Exception e)
    {
      throw new RuntimeException("error while determining database password",e);
    }
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcUrl()
   */
  public String getJdbcUrl()
  {
    String url = "jdbc:h2:" + Application.getPluginLoader().getPlugin(REIBACH.class).getResources().getWorkPath() + "/h2db/reibach";

    if (REIBACHDBService.SETTINGS.getBoolean("database.driver.h2.encryption",true))
      url += ";CIPHER=" + REIBACHDBService.SETTINGS.getString("database.driver.h2.encryption.algorithm","XTEA");
    if (REIBACHDBService.SETTINGS.getBoolean("database.driver.h2.recover",false))
    {
      Logger.warn("#############################################################");
      Logger.warn("## DATABASE RECOVERY ACTIVATED                             ##");
      Logger.warn("#############################################################");
      url += ";RECOVER=1";
    }
    return url;
  }

  /**
   * @see reibach.rmi.DBSupport#getJdbcUsername()
   */
  public String getJdbcUsername()
  {
    return "reibach";
  }

  /**
   * @see reibach.rmi.DBSupport#getScriptPrefix()
   */
  public String getScriptPrefix() throws RemoteException
  {
    return "h2-";
  }

  /**
   * @see reibach.rmi.DBSupport#getSQLTimestamp(java.lang.String)
   */
  public String getSQLTimestamp(String content) throws RemoteException
  {
    // Nicht noetig
    // return MessageFormat.format("DATEDIFF('MS','1970-01-01 00:00',{0})", new Object[]{content});
    return content;
  }

  /**
   * @see reibach.rmi.DBSupport#getInsertWithID()
   */
  public boolean getInsertWithID() throws RemoteException
  {
    return false;
  }

  /**
   * @see reibach.server.AbstractDBSupportImpl#checkConnection(java.sql.Connection)
   */
  public void checkConnection(Connection conn) throws RemoteException
  {
    // brauchen wir bei nicht, da Embedded
  }
}


/*********************************************************************
 * $Log: DBSupportH2Impl.java,v $
 * Revision 1.12  2010/11/02 12:02:19  willuhn
 *
 * Revision 1.11  2009/06/02 15:49:41  willuhn
 * @N method to display h2 database version
 *
 * Revision 1.10  2009/05/28 22:39:01  willuhn
 * @N Option zum Aktivieren des Recover-Modus. Siehe http://www.onlinebanking-forum.de/phpBB2/viewtopic.php?p=57830#57830
 *
 * Revision 1.9  2009/04/05 21:40:56  willuhn
 * @C checkConnection() nur noch alle hoechstens 10 Sekunden ausfuehren
 *
 * Revision 1.8  2008/12/30 15:21:40  willuhn
 * @N Umstellung auf neue Versionierung
 *
 * Revision 1.7  2007/12/06 17:57:21  willuhn
 * @N Erster Code fuer das neue Versionierungs-System
 *
 * Revision 1.6  2007/10/27 13:31:41  willuhn
 * @C Checksummen-Pruefung temporaer deaktiviert
 *
 * Revision 1.5  2007/10/02 16:08:55  willuhn
 * @C Bugfix mit dem falschen Spaltentyp nochmal ueberarbeitet
 *
 * Revision 1.4  2007/10/01 09:37:42  willuhn
 * @B H2: Felder vom Typ "TEXT" werden von H2 als InputStreamReader geliefert. Felder umsatz.kommentar und protokoll.nachricht auf "VARCHAR(1000)" geaendert und fuer Migration in den Gettern beides beruecksichtigt
 *
 * Revision 1.3  2007/08/23 13:07:38  willuhn
 * @C Uppercase-Verhalten nicht global sondern pro DBService konfigurierbar. Verhindert Fehler, wenn mehrere Plugins installiert sind
 *
 * Revision 1.2  2007/07/18 09:45:18  willuhn
 * @B Neue Version 1.8 in DB-Checks nachgezogen
 *
 * Revision 1.1  2007/06/25 11:21:19  willuhn
 * @N Support fuer H2-Datenbank (http://www.h2database.com/)
 *
 **********************************************************************/