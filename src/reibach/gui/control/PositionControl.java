package reibach.gui.control;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Position;

import de.willuhn.jameica.gui.AbstractControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.input.DecimalInput;
import de.willuhn.jameica.gui.input.Input;
import de.willuhn.jameica.gui.input.IntegerInput;
import de.willuhn.jameica.gui.input.SelectInput;
import de.willuhn.jameica.gui.input.TextAreaInput;
import de.willuhn.jameica.gui.input.TextInput;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Controller for the position view.
 */
public class PositionControl extends AbstractControl
{

	// the current position object
	private Position position;

	// the input fields for the position.
	private SelectInput bill;
	private TextInput name;
	private TextInput unit;
	private DecimalInput price;
	private DecimalInput amount;
	private TextInput pos_num;
	private DecimalInput quantity;
	private TextAreaInput comment;
	

  /**
   * ct.
   * @param view
   */
  public PositionControl(AbstractView view)
  {
    super(view);
  }

	/**
	 * Returns the current position.
   * @return the position.
   */
  private Position getPosition()
	{
		if (position != null)
			return position;
		position = (Position) getCurrentObject();
		return position;
	}

	/**
	 * Returns a the field to choose the bill.
   * @return the bill.
   * @throws RemoteException
   */
  public Input getBill() throws RemoteException
	{
		if (bill != null)
			return bill;
		
		bill = new SelectInput(Settings.getDBService().createList(Bill.class),getPosition().getBill());
    bill.setName(Settings.i18n().tr("Bill"));
    bill.setMandatory(true);
    return bill;
	}

	/**
	 * Returns an input field for the position name.
* @return input field.
* @throws RemoteException
*/
public Input getName() throws RemoteException
	{
		if (name != null)
			return name;
		// "255" is the maximum length of the name attribute.
		name = new TextInput(getPosition().getName(),255);
		name.setMandatory(true);
		name.setName(Settings.i18n().tr("Name"));
		return name;
	}


/**
 * Returns an input field for the position unit.
* @return input field.
* @throws RemoteException
*/
public Input getUnit() throws RemoteException
{
	if (unit != null)
		return unit;
	// "255" is the maximum length of the name attribute.
	unit = new TextInput(getPosition().getUnit(),255);
	unit.setMandatory(true);
	unit.setName(Settings.i18n().tr("Unit"));
	return unit;
}

/**
 * Returns an input field for the position unit.
* @return input field.
* @throws RemoteException
*/
public Input getPos_num() throws RemoteException
{
	if (pos_num != null)
		return pos_num;
	// "255" is the maximum length of the name attribute.
	pos_num = new TextInput(getPosition().getPos_num(),255);
	pos_num.setMandatory(true);
	pos_num.setName(Settings.i18n().tr("Pos_num"));
	return pos_num;
}

/**
 * Returns an input field for the task effort.
* @return input field.
* @throws RemoteException
*/
public Input getPrice() throws RemoteException
{
	if (price != null)
		return price;

	// we assign our system decimal formatter
	price = new DecimalInput(getPosition().getPrice(),Settings.DECIMALFORMAT);
	price.setName(Settings.i18n().tr("Price"));
	// price.setComment(Settings.i18n().tr("Hours [example: enter \"0,5\" to store 30 minutes]"));
	return price;
}


/**
 * Returns an input field for the task effort.
* @return input field.
* @throws RemoteException
*/
public Input getAmount() throws RemoteException
{
	if (amount != null)
		return amount;

	// we assign our system decimal formatter
	amount = new DecimalInput(getPosition().getAmount(),Settings.DECIMALFORMAT);
	amount.setName(Settings.i18n().tr("Amount"));
	// price.setComment(Settings.i18n().tr("Hours [example: enter \"0,5\" to store 30 minutes]"));
	return amount;
}

/**
 * Returns an input field for the task effort.
* @return input field.
* @throws RemoteException
*/
public Input getQuantity() throws RemoteException
{
	if (quantity != null)
		return quantity;

	// "255" is the maximum length of the name attribute.
	quantity = new DecimalInput(getPosition().getQuantity(),Settings.DECIMALFORMAT);
	quantity.setName(Settings.i18n().tr("Quantity"));
	return quantity;
}

	/**
	 * Returns an input field for the position comment.
   * @return input field.
   * @throws RemoteException
   */
  public Input getComment() throws RemoteException
	{
		if (comment != null)
			return comment;
		comment = new TextAreaInput(getPosition().getComment());
		comment.setName("");
		return comment;
	}
  
  /**
	 * This method stores the position using the current values. 
	 */
	public void handleStore()
	{
		try
		{

			// get the current position.
			Position t = getPosition();

			// invoke all Setters of this position and assign the current values
			t.setName((String) getName().getValue());
			t.setUnit((String) getUnit().getValue());
			t.setPos_num((String) getPos_num().getValue());
			
			// we can cast the value of the bill dialogInput directly to "Bill".
			t.setBill((Bill) getBill().getValue());

			// Anzahl bzw. Menge der Position
			Double q = (Double) getQuantity().getValue(); 
			t.setQuantity(q == null ? 0 : q.doubleValue());

			/*** Berechnung mittels NETTO - Verkaufspreis ***/
			
			// Einzelpreis netto
			// the DecimalInput fields returns a Double object
			/*
			 * Double d = (Double) getPrice().getValue(); 
			 * d = Math.round( d * 100. ) / 100.;
			 * t.setPrice(d == null ? 0.00 : d.doubleValue());
			 */
			
			// Betrag brutto bei 19 % MwSt Bruttobetrag = Menge * Nettobetrag ∙ (1 + Umsatzsteuersatz)
			// Double a = (Double) q * d * 1.19; 
			// a = Math.round( a * 100. ) / 100.;	
			// t.setAmount(a == null ? 0.0 : a.doubleValue());

			// Mehrwertsteuer in € berechnen
			/* Double x = (Double) q * d * 19/100 ; 
			x = Math.round( x * 100. ) / 100.;
			t.setTax(x == null ? 0.0 : x.doubleValue());
			*/

			/*** Berechnung mittels BRUTTO - Verkaufspreis ***/

			// Einzelpreis brutto
			// the DecimalInput fields returns a Double object
			 Double d = (Double) getPrice().getValue(); 
			 d = Math.round( d * 100. ) / 100.;
			 t.setPrice(d == null ? 0.00 : d.doubleValue());
			 

			// Einzelpreis brutto
			// Betrag brutto bei 19 % MwSt:  Bruttobetrag = Menge * Einzelpreis brutto 
			Double a = (Double) q * d; 
			a = Math.round( a * 100. ) / 100.;	
			t.setAmount(a == null ? 0.0 : a.doubleValue());
			
			/* Nettobetrag ermitteln
			 * Nettobetrag = Bruttobetrag : 1 + Umsatzsteuersatz
			 */
			Double n = (Double) a/1.19; 
			n = Math.round( n * 100. ) / 100.;
			
			// Mehrwertsteueranteil in € berechnen 
			// Umsatzsteuer = Bruttobetrag - Nettobetrag
			Double x = (Double) a - n;
			x = Math.round( x * 100. ) / 100.;
			t.setTax(x == null ? 0.0 : x.doubleValue());
			

			
			t.setComment((String) getComment().getValue());

			// Now, let's store the bill
			// The store() method throws ApplicationExceptions if
			// insertCheck() or updateCheck() failed.
			try
			{
				t.store();
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Position stored successfully"),StatusBarMessage.TYPE_SUCCESS));
			}
			catch (ApplicationException e)
			{
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
			}
		}
		catch (RemoteException e)
		{
			Logger.error("error while storing position",e);
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Position: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
		}
	}

}