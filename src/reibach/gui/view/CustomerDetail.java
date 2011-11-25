/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/view/CustomerDetail.java,v $
 * $Revision: 1.3 $
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
import reibach.gui.action.CustomerDelete;
import reibach.gui.control.CustomerControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.gui.util.ColumnLayout;
import de.willuhn.jameica.gui.util.Container;
import de.willuhn.jameica.gui.util.SimpleContainer;
import de.willuhn.util.ApplicationException;

/**
 * Detail view for customers.
 */
public class CustomerDetail extends AbstractView
{

  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception
  {
		// draw the title
		GUI.getView().setTitle(Settings.i18n().tr("Customer details"));

		// instanciate controller
		final CustomerControl control = new CustomerControl(this);
    
		Container c = new SimpleContainer(getParent());
		
    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
    Container left = new SimpleContainer(columns.getComposite());
    left.addHeadline(Settings.i18n().tr("Details"));
    
    //left.addInput(control.getCompany());
    left.addInput(control.getCompany());
    left.addInput(control.getTitle());
	
    left.addInput(control.getFirstname());
    left.addInput(control.getLastname());
    left.addHeadline(Settings.i18n().tr(""));
	
    left.addInput(control.getEmail());
    left.addInput(control.getTel());
    

    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr(""));
    
    // right.addHeadline(Settings.i18n().tr(""));
    right.addInput(control.getStreet());
    right.addInput(control.getHousenumber());

    right.addInput(control.getZipcode());
    right.addInput(control.getPlace());
    right.addHeadline(Settings.i18n().tr(""));

    right.addInput(control.getFax());
    right.addInput(control.getMobil());

    //right.addInput(control.getComment());

    // left side
    Container left1 = new SimpleContainer(columns.getComposite());
    left1.addHeadline(Settings.i18n().tr(""));
		// left.addInput(control.getProject());
		// left1.addInput(control.getFirstname());
		// left1.addInput(control.getLastname());

    // right side
    Container right1 = new SimpleContainer(columns.getComposite(),true);
    right1.addHeadline(Settings.i18n().tr("Description - will not be printed"));
    right1.addInput(control.getComment());

    
    // add some buttons
		ButtonArea buttons = new ButtonArea();

		buttons.addButton(new Back());
		buttons.addButton(Settings.i18n().tr("Delete"), new CustomerDelete(),control.getCurrentObject());
		buttons.addButton(Settings.i18n().tr("Store"),  new Action()
		{
			public void handleAction(Object context) throws ApplicationException
			{
				control.handleStore();
			}
		},null,true); // "true" defines this button as the default button

		// Don't forget to paint the button area
    buttons.paint(getParent());
  }
}


/**********************************************************************
 * $Log: CustomerDetail.java,v $
 * Revision 1.3  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/