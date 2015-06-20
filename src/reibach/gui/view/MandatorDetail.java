package reibach.gui.view;

import reibach.gui.action.MandatorDelete;
import reibach.gui.control.MandatorControl;
import reibach.Settings;
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
 * Detail view for mandators.
 */
public class MandatorDetail extends AbstractView
{

  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception
  {

	// draw the title
	GUI.getView().setTitle(Settings.i18n().tr("Mandator details"));

	// instanciate controller
	final MandatorControl control = new MandatorControl(this);

	Container c = new SimpleContainer(getParent());
	
    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
    Container left = new SimpleContainer(columns.getComposite());
    left.addHeadline(Settings.i18n().tr("Details"));
    
    left.addInput(control.getCompany());
    left.addInput(control.getSlogan());
    left.addInput(control.getTitle());
	
    left.addInput(control.getFirstname());
    left.addInput(control.getLastname());
    // left.addHeadline(Settings.i18n().tr(""));
    left.addInput(control.getStreet());
    left.addInput(control.getHousenumber());

 	
    

    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr(""));
    right.addInput(control.getZipcode());
    right.addInput(control.getPlace());
    right.addInput(control.getEmail());
    right.addInput(control.getWebsite());
    right.addInput(control.getTel());
    right.addInput(control.getFax());
    right.addInput(control.getMobil());
    
    // right.addHeadline(Settings.i18n().tr(""));
    // right.addHeadline(Settings.i18n().tr(""));
    // right.addInput(control.getComment());

    // left side
    // Container left1 = new SimpleContainer(columns.getComposite());
    // left1.addHeadline(Settings.i18n().tr("\n\n\n"));
		// left.addInput(control.getProject());
		// left1.addInput(control.getFirstname());
		// left1.addInput(control.getLastname());

    // right side
    // Container right1 = new SimpleContainer(columns.getComposite(),true);
    // right1.addHeadline(Settings.i18n().tr("Description - will not be printed"));
    // right1.addInput(control.getComment());

    // left side
    Container left2 = new SimpleContainer(columns.getComposite());
    left2.addHeadline(Settings.i18n().tr("Bank"));
    left2.addInput(control.getBankname());
    left2.addInput(control.getBankaccount());
    left2.addInput(control.getBankcodenumber());
    left2.addInput(control.getIban());
    left2.addInput(control.getBic());

    // right side
    Container right2 = new SimpleContainer(columns.getComposite(),true);
    right2.addHeadline(Settings.i18n().tr("TAX"));
    right2.addInput(control.getTaxoffice());
    right2.addInput(control.getVatnumber());
    right2.addInput(control.getTaxnumber());

    
    // add some buttons
	ButtonArea buttons = new ButtonArea();

	buttons.addButton(new Back());
	buttons.addButton(Settings.i18n().tr("Delete"), new MandatorDelete(),control.getCurrentObject());
	buttons.addButton(Settings.i18n().tr("Store"),  new Action()
	{
		public void handleAction(Object context) throws ApplicationException
		{
			control.handleStore();
		}
	},null,true); // "true" defines this button as the default button

	/***
	* Schalter um DefaultWerte in die Tabelle mandator einzutragen, 
	* Methode control.handleStoreDefault ist in gui.control/MandatorControl
	****/
	buttons.addButton(Settings.i18n().tr("StoreDefault"),  new Action()
	{
		public void handleAction(Object context) throws ApplicationException
		{
			control.handleStoreDefault();
		}
	},null,true); // "true" defines this button as the default button
	
	// Don't forget to paint the button area
    buttons.paint(getParent());
  }
}
