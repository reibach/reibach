/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/view/ProjectList.java,v $
 * $Revision: 1.4 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/
package reibach.gui.view;

import reibach.Settings;
import reibach.gui.action.PositionDetail;
import reibach.gui.control.PositionControl;
import reibach.io.AboutPdf;
import reibach.io.Demo;
import reibach.io.printPdf;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;

 
/**
 * View to show the list of existing projects.
 */
public class PositionofBillList extends AbstractView
{

  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception {

		GUI.getView().setTitle(Settings.i18n().tr("Existing positions"));
		PositionControl control = new PositionControl(this);
		
		// control.getPositionsTable().paint(this.getParent());
		
		ButtonArea buttons = new ButtonArea();
		buttons.addButton(new Back());
		
		// the last parameter "true" makes the button the default one
		buttons.addButton(Settings.i18n().tr("Create new position"), new PositionDetail(),null,true);
		buttons.addButton(Settings.i18n().tr("PdfPrint"), new AboutPdf(),null,true);
		
		buttons.paint(getParent());
		
  }
}


/**********************************************************************
 * $Log: PositionList.java,v $
 * Revision 1.4  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/