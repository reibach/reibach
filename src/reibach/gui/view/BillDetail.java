/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/view/BillDetail.java,v $
 * $Revision: 1.5 $
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
import reibach.gui.action.BillDelete;
import reibach.gui.action.PositionDetail;
import reibach.gui.control.BillControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.gui.util.ColumnLayout;
import de.willuhn.jameica.gui.util.Container;
import de.willuhn.jameica.gui.util.Headline;
import de.willuhn.jameica.gui.util.SimpleContainer;
import de.willuhn.util.ApplicationException;


/**
 * this is the dialog for the bill details. 
 */
public class BillDetail extends AbstractView
{

	/**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
	public void bind() throws Exception
	{
    // draw the title
		GUI.getView().setTitle(Settings.i18n().tr("Bill details"));

    // instanciate controller
    final BillControl control = new BillControl(this);

    Container c = new SimpleContainer(getParent());

    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
    Container left = new SimpleContainer(columns.getComposite());
    left.addHeadline(Settings.i18n().tr("Details"));
    left.addInput(control.getCustomer());
    left.addInput(control.getName());
    left.addInput(control.getPrice());
    left.addInput(control.getBillDate());
    
    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr("Description"));
    right.addInput(control.getDescription());
    
    c.addHeadline(Settings.i18n().tr("Summary"));
		c.addInput(control.getEffortSummary());

    // add some buttons
    ButtonArea buttons = new ButtonArea();
    buttons.addButton(new Back());
    buttons.addButton(Settings.i18n().tr("New Position"), new PositionDetail(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Delete"),  	new BillDelete(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Store"),   	new Action()
    {
      public void handleAction(Object context) throws ApplicationException
      {
        control.handleStore();
      }
    },null,true); // "true" defines this button as the default button

    // Don't forget to paint the button area
    buttons.paint(getParent());

		// show position positions in this bill
		new Headline(getParent(),Settings.i18n().tr("Position within this bill"));
		control.getPositionList().paint(getParent());
	}

	/**
   * @see de.willuhn.jameica.gui.AbstractView#unbind()
   */
  public void unbind() throws ApplicationException
	{
    // this method will be invoked when leaving the dialog.
    // You are able to interrupt the unbind by throwing an
    // ApplicationException.
	}

}


/**********************************************************************
 * $Log: BillDetail.java,v $
 * Revision 1.5  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/