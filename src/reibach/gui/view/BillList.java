package reibach.gui.view;

import java.util.Locale;

import reibach.Settings;
import reibach.gui.action.BillDetail;
import reibach.gui.control.BillControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.logging.Logger;

 
/**
 * View to show the list of existing bills
 */
public class BillList extends AbstractView
{

	
	Locale l = Locale.GERMANY;
	// String lang    = Locale.getLanguage();
    // String country = this.locale.getCountry();
	
  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception {

// 		GUI.getView().setTitle(Settings.i18n().tr("Existing bills"+l));
		GUI.getView().setTitle(Settings.i18n().tr("Existing bills"));

		// GUI.getView().setTitle(Settings.i18n().tr("checking resource bundle for language"));

		
		BillControl control = new BillControl(this);
		
		control.getBillsTable().paint(this.getParent());
		
		ButtonArea buttons = new ButtonArea();
		buttons.addButton(new Back());
		
		// the last parameter "true" makes the button the default one
		buttons.addButton(Settings.i18n().tr("Create new bill"), new BillDetail(),null,true);
		// buttons.addButton(Settings.i18n().tr("PdfPrint"), new AboutPdf(),null,true);
		
		buttons.paint(getParent());
		
  }
}
