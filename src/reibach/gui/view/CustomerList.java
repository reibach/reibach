package reibach.gui.view;

import reibach.Settings;
import reibach.gui.action.CustomerDetail;
import reibach.gui.control.CustomerControl;
import reibach.io.AboutPdf;
import reibach.REIBACH;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.system.Application;
import de.willuhn.util.I18N;

 
/**
 * View to show the list of existing projects.
 */
public class CustomerList extends AbstractView
{
	
	  private final static I18N i18n = Application.getPluginLoader().getPlugin(REIBACH.class).getResources().getI18N();


  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception {

		// Die Exception fliegt nur bei RMI-Kommunikation mit fehlendem RMI-Server
	    //   I18N i18n = Application.getPluginLoader().getPlugin(REIBACH.class).getResources().getI18N();
	    //   String host = Application.getServiceFactory().getLookupHost(REIBACH.class,"database");
	    //  int    port = Application.getServiceFactory().getLookupPort(REIBACH.class,"database");
	    //  String msg = i18n.tr("Hibiscus-Server \"{0}\" nicht erreichbar", (host + ":" + port));
	  
		GUI.getView().setTitle(Settings.i18n().tr("Existing customers"));
		CustomerControl control = new CustomerControl(this);
		
		control.getCustomersTable().paint(this.getParent());
		
		ButtonArea buttons = new ButtonArea();
		buttons.addButton(new Back());
		
		// the last parameter "true" makes the button the default one
		// buttons.addButton(Settings.i18n().tr("Create new customer"), new CustomerDetail(),null,true);
		// buttons.addButton(Settings.i18n().tr("Create new customer"), new CustomerDetail(),null,true);
		buttons.addButton(i18n.tr("Create new customer"), new CustomerDetail(),null,true);
		
		buttons.paint(getParent());
		
  }
}

