package reibach.rmi;

import de.willuhn.datasource.rmi.DBService;
import de.willuhn.jameica.system.Settings;

/**
 * Interface for our database service.
 */
public interface REIBACHDBService extends DBService
{
	  /**
	   * Einstellungen fuer die DB-Services.
	   */
	  public final static Settings SETTINGS = new Settings(REIBACHDBService.class);

}

