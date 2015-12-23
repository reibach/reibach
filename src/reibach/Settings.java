package reibach;

import java.rmi.RemoteException;
import java.text.DateFormat;
import java.text.DecimalFormat;
import java.text.SimpleDateFormat;

import de.willuhn.datasource.rmi.DBService;
// import de.willuhn.jameica.fibu.Fibu;
import de.willuhn.jameica.system.Application;
import de.willuhn.util.I18N;

/**
 * Verwaltet die Einstellungen des Plugins.
 * @author gm
 */
public class Settings
{

	private static DBService db;
	private static I18N i18n;

	
	  /**
	   * Die Settings.
	   */
	  public final static de.willuhn.jameica.system.Settings SETTINGS = new de.willuhn.jameica.system.Settings(REIBACH.class);


/**
   * Dateformatter.
   */
  public final static DateFormat LONGDATEFORMAT   = new SimpleDateFormat("dd.MM.yyyy HH:mm:ss");

  /**
   * Our DateFormatter.
   */
   // public final static DateFormat DATEFORMAT = DateFormat.getDateInstance(DateFormat.DEFAULT, Application.getConfig().getLocale());
  
  /**
   * Dateformatter.
   */
  public final static DateFormat DATEFORMAT       = new SimpleDateFormat("dd.MM.yyyy");

  
  
  /**
   * Our decimal formatter.
   */
  public final static DecimalFormat DECIMALFORMAT = (DecimalFormat) DecimalFormat.getInstance(Application.getConfig().getLocale());

  /**
   * Our currency name.
   */
  public final static String CURRENCY = "EUR";

	static
	{
		DECIMALFORMAT.setMinimumFractionDigits(2);
		DECIMALFORMAT.setMaximumFractionDigits(2);
	}

	
	
	/**
	 * Small helper function to get the database service.
   * @return db service.
   * @throws RemoteException
   */
  public static DBService getDBService() throws RemoteException
	{
		if (db != null)
			return db;

		try
		{
			// We have to ask Jameica's ServiceFactory.
			// If we are running in Client/Server mode and we are the
			// client, the factory returns the remote dbService from the
			// Jameica server.
			// The name and class of the service is defined in plugin.xml
			db = (DBService) Application.getServiceFactory().lookup(REIBACH.class,"reibachdatabase");
			return db;
		}
		catch (Exception e)
		{
			throw new RemoteException("error while getting database service",e);
		}
	}
	
	/**
	 * Small helper function to get the translator.
   * @return translator.
   */
  public static I18N i18n()
	{
		if (i18n != null)
			return i18n;
		i18n = Application.getPluginLoader().getPlugin(REIBACH.class).getResources().getI18N();
		return i18n; 
	}
  
}