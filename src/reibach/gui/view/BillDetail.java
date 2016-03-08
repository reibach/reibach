package reibach.gui.view;
import reibach.Settings;
import reibach.gui.action.BillDelete;
import reibach.gui.action.BillPrintPdf;
import reibach.gui.action.PositionDetail;
import reibach.gui.control.BillControl;
import reibach.io.AboutPdf;
import reibach.rmi.Position;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.input.DecimalInput;
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

    // control.getBillsID().paint(this.getParent());
    Container c = new SimpleContainer(getParent());

    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
     Container left = new SimpleContainer(columns.getComposite());
    // left.addHeadline(Settings.i18n().tr("Bill Details"));

    // Rechnungsnummer ausgeben
    String bill_id = control.getBill().getID();
    left.addHeadline(Settings.i18n().tr("Bill number") + ": " + bill_id);

    left.addInput(control.getStatus());
    left.addInput(control.getMandator());
    left.addInput(control.getCustomer());
    left.addInput(control.getBillDate());
    
    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr("Description"));
    right.addInput(control.getDescription());
    
    c.addHeadline(Settings.i18n().tr("Summary"));
	//c.addInput(control.getEffortSummary());
	c.addInput(control.getEffortSummary());

    // add some buttons
    ButtonArea buttons = new ButtonArea();
    buttons.addButton(new Back());
    buttons.addButton(Settings.i18n().tr("New Position"), new PositionDetail(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Delete"),  	new BillDelete(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Print Bill"), new BillPrintPdf(),control.getCurrentObject());
 
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
		new Headline(getParent(),Settings.i18n().tr("Positions within this bill"));
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