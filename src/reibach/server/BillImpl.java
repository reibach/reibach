package reibach.server;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.util.Date;

import com.itextpdf.text.*;
import com.itextpdf.text.pdf.*;

import reibach.Settings;
// import reibach.io.AboutPdf.HeaderFooter;
import reibach.gui.action.PositionDetail;
import reibach.gui.menu.PositionListMenu;
import reibach.rmi.Bill;
import reibach.rmi.Customer;
import reibach.server.CustomerImpl;
import reibach.rmi.Position;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.Part;
import de.willuhn.jameica.gui.formatter.Formatter;
import de.willuhn.jameica.gui.parts.ContextMenuItem;
import de.willuhn.jameica.gui.parts.TablePart;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * This is the implemtor of the bill interface.
 * You never need to instanciate this class directly.
 * Instead of this, use the dbService to find the right
 * implementor of your interface.
 * Example:
 * 
 * DBService service = (DBService) Application.getServiceFactory().lookup(ReibachPlugin.class,"exampledatabase");
 * 
 * a) create new bill
 * Bill bill = (Bill) service.createObject(Bill.class,null);
 * 
 * b) load existing bill with id "4".
 * Bill bill = (Bill) service.createObject(Bill.class,"4");
 * 
 * c) list existing bills
 * DBIterator bills = service.createList(Bill.class);
 */
public class BillImpl extends AbstractDBObject implements Bill
{
	private static Font logo = new Font(Font.FontFamily.HELVETICA, 18, Font.BOLDITALIC);
	private static Font headline = new Font(Font.FontFamily.HELVETICA, 18, Font.BOLD);
	private static Font subHeadline = new Font(Font.FontFamily.HELVETICA, 16, Font.BOLD);

	private static Font chapter = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	private static Font chapterRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);

	
	private static Font normal = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	private static Font normalRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);
	
	private static Font smallBold = new Font(Font.FontFamily.HELVETICA , 8, Font.BOLD);
	private static Font smallFont = new Font(Font.FontFamily.HELVETICA , 8, Font.NORMAL);
	/**
   * @throws RemoteException
   */
	
	
  public BillImpl() throws RemoteException
  {
    super();
  }

  /**
   * We have to return the name of the sql table here.
	 * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
	 */
	protected String getTableName()
	{
		return "bill";
	}

  /**
   * Sometimes you can display only one of the bills attributes (in combo boxes).
   * Here you can define the name of this field.
   * Please dont confuse this with the "primary KEY".
   * @see de.willuhn.datasource.GenericObject#getPrimaryAttribute()
	 */
	public String getPrimaryAttribute() throws RemoteException
	{
    // we choose the bills name as primary field.
		return "name";
	}

	/**
   * This method will be called, before delete() is executed.
   * Here you can make some dependency checks.
   * If you dont want to delete the bill (in case of failed dependencies)
   * you have to throw an ApplicationException. The message of this
   * one will be shown in users UI. So please translate the text into
   * the users language.
	 * @see de.willuhn.datasource.db.AbstractDBObject#deleteCheck()
	 */
	protected void deleteCheck() throws ApplicationException
	{
	}

	/**
   * This method is invoked before executing insert().
   * So lets check the entered data.
	 * @see de.willuhn.datasource.db.AbstractDBObject#insertCheck()
	 */
	protected void insertCheck() throws ApplicationException
	{
    try {
        if (getName() == null || getName().length() == 0)
            throw new ApplicationException(Settings.i18n().tr("Please enter a bill name"));
         
        if (getCustomer() == null)
            throw new ApplicationException(Settings.i18n().tr("Please create a Customer first"));
         
    }
    catch (RemoteException e)
    {
      Logger.error("insert check of bill failed",e);
      throw new ApplicationException(Settings.i18n().tr("unable to store bill, please check the system log"));
    }
	}

	/**
   * This method is invoked before every update().
	 * @see de.willuhn.datasource.db.AbstractDBObject#updateCheck()
	 */
	protected void updateCheck() throws ApplicationException
	{
    // we simply call the insertCheck here ;)
    insertCheck();
	}

	/**
	 * @see de.willuhn.datasource.db.AbstractDBObject#getForeignObject(java.lang.String)
	
	protected Class getForeignObject(String arg0) throws RemoteException
	{
    // We dont have any foreign keys here. Please check PositionImpl.java
    // if you want to see an example.
		return super.getForeignObject(arg0);
	}
	 */

	 /**
	   * @see reibach.rmi.Bill#getCustomer
	   */
	  public Customer getCustomer() throws RemoteException
	  {
	  	// Yes, we can cast this directly to Customer, because getForeignObject(String)
	  	// contains the mapping for this attribute.
	  	try
	  	{
				return (Customer) getAttribute("customer_id");
	  	}
	  	catch (ObjectNotFoundException e)
	  	{
	  		return null;
	  	}
	  }

	  /**
	   * @see de.willuhn.datasource.db.AbstractDBObject#getForeignObject(java.lang.String)
	   */
	  protected Class getForeignObject(String field) throws RemoteException
	  {
			// the system is able to resolve foreign keys and loads
			// the according objects automatically. You only have to
			// define which class handles which foreign key.
	  	if ("customer_id".equals(field))
	  		return Customer.class;
	    return null;
	  }


	/**
	 * @see reibach.rmi.Bill#getName()
	 */
	public String getName() throws RemoteException
	{
    // Wen can cast this directly to String, the method getField() knows the
    // meta data of this sql table ;)
		return (String) getAttribute("name"); // "name" ist the sql field name
	}

	
	/**
	 * @see reibach.rmi.Bill#getDescription()
	 */
	public String getDescription() throws RemoteException
	{
		return (String) getAttribute("description");
	}

	/**
	 * @see reibach.rmi.Bill#getEmail()
	 */
	public String getEmail() throws RemoteException
	{
    return (String) getAttribute("email");
	}

	/**
	 * @see reibach.rmi.Bill#getPrice()
	 */
	public double getPrice() throws RemoteException
	{
    // AbstractDBObject will create a java.lang.Double.
    // We only have to cast it.
    Double d = (Double) getAttribute("price");
    return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
	}

	/**
	 * @see reibach.rmi.Bill#getBillDate()
	 */
	public Date getBillDate() throws RemoteException
	{
		// getField() knows this type too
		return (Date) getAttribute("billdate");
	}

	/**
	 * @see reibach.rmi.Bill#setName(java.lang.String)
	 */
	public void setName(String name) throws RemoteException
	{
    // Please use setField(<fieldname>,<value>) to store the data into the right field.
    setAttribute("name",name);
	}


	/**
	 * @see reibach.rmi.Bill#setCustomer(java.lang.String)
	 */
	public void setCustomer(Customer customer) throws RemoteException
	{
    // Please use setField(<fieldname>,<value>) to store the data into the right field.
    	setAttribute("customer_id",customer);
	}


	/**
	 * @see reibach.rmi.Bill#setDescription(java.lang.String)
	 */
	public void setDescription(String description) throws RemoteException
	{
    setAttribute("description",description);
	}

	/**
	 * @see reibach.rmi.Bill#setPrice(double)
	 */
	public void setPrice(double price) throws RemoteException
	{
    // setField() wants to have an object but <prive> is a primitive type.
    // So we have to make a java.lang.Double
    setAttribute("price",new Double(price));
  }

	/**
	 * @see reibach.rmi.Bill#setStartDate(java.util.Date)
	 */
	public void setBillDate(Date billDate) throws RemoteException
	{
		setAttribute("billdate",billDate);
	}

	/**
	 * @see reibach.rmi.Bill#getPositions()
	 */
	public DBIterator getPositions() throws RemoteException
	{
    try
    {
      // 1) Get the Database Service.
      DBService service = this.getService();

      // you can get the Database Service also via:
      // DBService service = this.getService();
      
      // 3) We create the position list using getList(Class)
      DBIterator positions = service.createList(Position.class);
      
      // 4) we add a filter to only query for positions with our bill id
      positions.addFilter("bill_id = " + this.getID());
      
      return positions;
    }
    catch (Exception e)
    {
    	throw new RemoteException("unable to load position list",e);
    }
	}

  /**
   * @see reibach.rmi.Bill#getEfforts()
   */
  public double getEfforts() throws RemoteException
  {
  	double sum = 0.0;
  	DBIterator i = getPositions();
  	while (i.hasNext())
  	{
  		Position t = (Position) i.next();
  		sum += t.getPrice();
  	}
  	return sum;
  }

  public void BillPrintPdf() throws RemoteException, ApplicationException
  {


	  	Paragraph pos = new Paragraph(); 
	    // We add one empty line
	    addEmptyLine(new Paragraph(""),2);

	    /***
	    pos.add(new Paragraph(positions));
		positionList = new TablePart(positions,new PositionDetail());
		positionList.addColumn(Settings.i18n().tr("Position name"),"name");
		positionList.addColumn(Settings.i18n().tr("Effort"),"effort",new Formatter()
		***///
	    
	  	// DBIterator positions = getPositions();
	
	  	// pos.add(new Paragraph(sum));
	   // document.add(pos);
	      
	  
	  
	    // Get the Data of mandator
	  
	    // Get the Data of Customer
	    String customerCompany = getCustomer().getCompany();
	  	String customerTitle = getCustomer().getTitle();
	  	String customerFirstname = getCustomer().getFirstname();
	    String customerLastname = getCustomer().getLastname();
	  	// String customerName = getCustomer().getLastname();
	  	 
	  	// company = new CustomerImpl
	  	// String company = getCompany().toString();
	    
	  	String name = getName();
	  	Double price = getPrice();
	  	Double efforts = getEfforts();
	  	// String effortSummary = getEffortSummary().toString();
	  	
	  	
	  	String billdate = getBillDate().toString();
	  	
	  	// String positions = getPositions().toString();
		
	  	// DBIterator positions = getPositions();
	  	// String positionComment = getPosition();
	  	
	  	String description = getDescription();

	 
	    // Get the Data of the positions
	  	//String summary = getSummary();
	  	
		/**
		 * Returns a list of positions in this bill.
	   * @return list of positions in this bill
	   * @throws RemoteException
	   */


	  	
	  
	  	
	  	try
	  	{

		  	/*
	  	   * Getting some fonts
	  	   */
	        BaseFont bf_helv_bold = BaseFont.createFont(BaseFont.HELVETICA_BOLD, "Cp1252", false);
	        BaseFont bf_helv = BaseFont.createFont(BaseFont.HELVETICA, "Cp1252", false);
	        BaseFont bf_helv_obl = BaseFont.createFont(BaseFont.HELVETICA_OBLIQUE, "Cp1252", false);
	        BaseFont bf_helvbold_obl = BaseFont.createFont(BaseFont.HELVETICA_BOLDOBLIQUE, "Cp1252", false);

		  	/*
		  	 *  generate the pdf
		  	 */
			  OutputStream file = new FileOutputStream(new File("/tmp/Test.pdf"));
			
			  Document document = new Document(PageSize.A4, 36, 36, 54, 36);
			  // String FILE = "/tmp/testme.pdf";
			  PdfWriter writer = PdfWriter.getInstance(document, file);
			  writer.setBoxSize("art", new Rectangle(36, 54, 559, 788));
			
			  // headers and footers must be added before the document is opened
			  HeaderFooter event = new HeaderFooter();
			  writer.setPageEvent(event);
			  
			  PdfWriter.getInstance(document, file);
			  document.open();
			  
			  PdfContentByte cb = writer.getDirectContent();
			
			  // Start FOOTER , Daten des Mandanten
			  // add text at an absolute position
			  cb.beginText();
			  cb.setFontAndSize(bf_helv, 7);
			
			cb.setTextMatrix(10, 10);
			cb.showText("Germany");
			cb.setTextMatrix(10, 20);
			cb.showText("27729 Holste");
			cb.setTextMatrix(10, 30);
			cb.showText("Buxhormer Weg 15");
			cb.setTextMatrix(10, 40);
			cb.setFontAndSize(bf_helv_bold, 8);
			cb.showText("federa - Günter Mittler");
			
			cb.setFontAndSize(bf_helv, 7);
			cb.setTextMatrix(150, 10);
			cb.showText("Internet: http://federa.de");
			cb.setTextMatrix(150, 20);
			cb.showText("E-Mail: guenter@federa.de");
			cb.setTextMatrix(150, 30);
			cb.showText("Fax:  +49(0)4748 442438");
			cb.setTextMatrix(150, 40);
			cb.showText("Tel:  +49(0)4748 442437");
            
            cb.setTextMatrix(350, 10);
            cb.showText("BLZ: 29152300");
            cb.setTextMatrix(350, 20);
            cb.showText("Konto: 140180666");
            cb.setTextMatrix(350, 30);
            cb.showText("Kreissparkasse Osterholz");
            cb.setTextMatrix(350, 40);
            cb.showText("Bankverbindung");
            
            // cb.setTextMatrix(500, 10);
            // cb.showText("BLZ: 29152300");
            cb.setTextMatrix(500, 20);
            cb.showText("36/130/11311");
            cb.setTextMatrix(500, 30);
            cb.showText("UST-IdNr. DE813084387");
            cb.setTextMatrix(500, 40);
            cb.showText("Finanzamt Osterholz ");
            
            cb.setTextMatrix(500, 6);
            cb.setFontAndSize(bf_helv, 4);
            cb.showText("generated by: ");

            cb.setTextMatrix(530, 6);
            cb.setFontAndSize(bf_helv_bold, 5);
            cb.showText(" Reibach ");

            cb.setTextMatrix(530, 2);
            cb.setFontAndSize(bf_helv_obl, 4);
            cb.showText(" ... to make a big haul ");
            
            cb.endText();
            // END FOOTER
            
         // Autor, Eigenschaften des Dokumentes   
			addMetaData(document);
			
			// Logo, Slogan, Rechnung, Rechnungsnummer, Rechnungsdatum  
			addMandatoryTitle(document);
			
			// addTitlePage(document);
			
			Paragraph bill = new Paragraph();
			bill.add(new Paragraph("Rechnung", subHeadline));
			bill.add(new Paragraph("Rechnungsnummer: " + name , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("EFFORTS: " + efforts , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("PRICE: " + price , normal));
			addEmptyLine(bill, 2);
			// bill.add(new Paragraph("POSITIONS: " + positions , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("DESCRIPTION: " + description , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("COMPANY: " + customerCompany , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("TITLE: " + customerTitle , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("FIRSTNAME: " + customerFirstname , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("LASTNAME: " + customerLastname , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph("KUNDENNAME: " + customerLastname , normal));
			addEmptyLine(bill, 2);
			bill.add(new Paragraph(billdate , normal));
			addEmptyLine(bill, 2);
			bill.setAlignment(Element.ALIGN_RIGHT);
			// We add one empty line
			addEmptyLine(bill, 2);
			
			document.add(bill);
			
			Paragraph cust = new Paragraph(); 
		    // We add one empty line
		    addEmptyLine(new Paragraph(""),2);

		    // cust.add(new Paragraph(customerName));
		    addEmptyLine(cust,2);
		    document.add(cust);
		      
			// Paragraph pos = new Paragraph(); 
		    // We add one empty line
		    addEmptyLine(new Paragraph(""),2);

		    /***
		    pos.add(new Paragraph(positions));
			positionList = new TablePart(positions,new PositionDetail());
			positionList.addColumn(Settings.i18n().tr("Position name"),"name");
			positionList.addColumn(Settings.i18n().tr("Effort"),"effort",new Formatter()
			***///
		    
		  	// DBIterator positions = getPositions();
		
		  	
		    //pos.add(new Paragraph(efforts));
		    // pos.add(new Paragraph(price));
		    addEmptyLine(cust,2);
		    document.add(pos);
		      
		      /*
		      document.add(new Paragraph("price --->"));
		      document.add(new Paragraph(price.toString()));
		      document.add(new Paragraph("<---- price "));
		      document.add(new Paragraph(""));
		      
		      document.add(new Paragraph("billdate --->"));
		      document.add(new Paragraph(billdate));
		      document.add(new Paragraph("<---- billdate "));
		      document.add(new Paragraph(""));
		
		      document.add(new Paragraph("description --->"));
		      document.add(new Paragraph(description));      
		      document.add(new Paragraph("<---- description "));
		      document.add(new Paragraph(""));
		      
		      document.add(new Paragraph("Printing Date: "));
		      document.add(new Paragraph(""));
		      document.add(new Paragraph(new Date().toString()));
				*/

            
            // step 4	        
			/*
			 *
			 */
            
			addContent(document);
			/*
			 * Kundendaten inkl. Zahlweise
			 * addCustomer(document);
			 * 
			 * Rechnungspositionen, Summe, Mehrwertsteuer 
			 * addPositions(document);
			
			 */
			

	      
	
	      document.close();
	      file.close();
	  	} catch (Exception e) {
			throw new ApplicationException(Settings.i18n().tr("error while printingaaaaaa the bill"),e);
		} 
  }
  
  /** Inner class to add a header and a footer. */
  static class HeaderFooter extends PdfPageEventHelper {

      public void onEndPage (PdfWriter writer, Document document) {
          Rectangle rect = writer.getBoxSize("art");
          ColumnText.showTextAligned(writer.getDirectContent(),
                  Element.ALIGN_CENTER, new Phrase(String.format("Seite %d", writer.getPageNumber())),
                  (rect.getLeft() + rect.getRight()) / 2, rect.getBottom() - 28, 0);        
      }
  }

	// iText allows to add metadata to the PDF which can be viewed in your Adobe
	// Reader
	// under File -> Properties
	private static void addMetaData(Document document) {
		document.addTitle("federa: Internet - Support - Sicherheit");
		document.addSubject("Rechnung");
		document.addKeywords("Internet - Support - Sicherheit");
		document.addAuthor("gm");
		document.addCreator("gm");
	}
	private static void addCustomer(Document document)	throws DocumentException {
		 
		  
		//Addressdaten Kunde
		Paragraph customer_address = new Paragraph();
		customer_address.add(new Paragraph("company" , normal));
		customer_address.add(new Paragraph("title" , normal));
		customer_address.add(new Paragraph("firstname lastname" , normal));
		customer_address.add(new Paragraph("street housenumber" , normal));
		customer_address.add(new Paragraph("zipcode place" , normal));
		
		// We add one empty line
		addEmptyLine(customer_address, 2);
		
		customer_address.add(new Paragraph("customer_id", normal));
		customer_address.add(new Paragraph("payment", normal));

		// We add one empty line
		addEmptyLine(customer_address, 2);
		
	    document.add(new Paragraph("Printing da Bill"));
	    document.add(new Paragraph(""));
	      
	    document.add(new Paragraph("customer --->"));
	    // document.add(new Paragraph(customer));
	    document.add(new Paragraph("<---- customer"));
	    document.add(new Paragraph(""));
	    
		document.add(customer_address);
	}
	
	private static void addMandatoryTitle(Document document)	throws DocumentException {
		// Lets write a big header
		Paragraph manTitle = new Paragraph();
		manTitle.add(new Paragraph("federa", logo));
		manTitle.add(new Paragraph("Internet - Support - Sicherheit", smallFont));
		document.add(manTitle);	
	}
	
	private static void addTitlePage(Document document)	throws DocumentException {
		Paragraph companiename = new Paragraph();
		
		// We add one empty line
		addEmptyLine(companiename, 1);	

		


		//Addressdaten Kunde
		Paragraph customer_address = new Paragraph();
		customer_address.add(new Paragraph("company" , normal));
		customer_address.add(new Paragraph("title" , normal));
		customer_address.add(new Paragraph("firstname lastname" , normal));
		customer_address.add(new Paragraph("street housenumber" , normal));
		customer_address.add(new Paragraph("zipcode place" , normal));
		
		// We add one empty line
		addEmptyLine(customer_address, 2);
		
		customer_address.add(new Paragraph("customer_id", normal));
		//customer_address.add(new Paragraph(name, normal));
		customer_address.add(new Paragraph("payment", normal));

		// We add one empty line
		addEmptyLine(customer_address, 2);
				
		document.add(customer_address);
	}		
		
		private static void addContent(Document document) throws DocumentException {
			PdfPTable table = new PdfPTable(6);

			table.setWidthPercentage(100);
			table.setTotalWidth(new float[]{ 50, 300, 50 , 40 , 40, 40, });
		    table.setLockedWidth(true);
  			
			PdfPCell c1 = new PdfPCell(new Phrase("Position"));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("Beschreibung"));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("Menge"));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("Preis"));
			// c1.setHorizontalAlignment(Element.ALIGN_CENTER);
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("MwSt"));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("Betrag"));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
				
			
			table.setHeaderRows(1);
			
			table.addCell("1.0");
			table.addCell("1.1 Rund 3 Millionen Rechner wProzent) als die der Desktop-Systeme (–5,9 Prozent). ");
			table.addCell("1.2");
			table.addCell("1.3");
			table.addCell("1.4");
			table.addCell("1.5");
			table.addCell("2.1");
			table.addCell("2.2 Rund 3 Millionen Rechner w) als die der Desktop-Systeme (–5,9 Prozent).");
			table.addCell("2.3");
			table.addCell("2.4");
			table.addCell("2.5");
			table.addCell("2.6");
		
			table.addCell("3.1");
			table.addCell("3.2 Rund 3 Millionen Rechner wmobilen Rechnern stärker nach (–8,8 Prozent) als die der Desktop-Systeme (–5,9 Prozent).");
			table.addCell("3.3");
			table.addCell("3.4");
			table.addCell("3.5");
			table.addCell("3.6");
			document.add(table);
			
		
			// We add one empty line
			Paragraph space = new Paragraph();
			space.add(new Paragraph("" , subHeadline));
			addEmptyLine(space, 2);
			document.add(space);
			
		}
		private static void addEmptyLine(Paragraph paragraph, int number) {
			for (int i = 0; i < number; i++) {
				paragraph.add(new Paragraph(" "));
			}
		}			
		private static void addFilledLine(Paragraph paragraph, String string) {
				paragraph.add(new Paragraph(string));
		}			
		
		
		
  /**
   * We overwrite the delete method to delete all assigned positions too.
   * @see de.willuhn.datasource.rmi.Changeable#delete()
   */
  public void delete() throws RemoteException, ApplicationException
  {
  	try
  	{
  		// we start a new transaction
  		// to delete all or nothing
  		this.transactionBegin();

			DBIterator positions = getPositions();
			while (positions.hasNext())
			{
				Position t = (Position) positions.next();
				t.delete();
			}
			super.delete(); // we delete the bill itself

			// everything seems to be ok, lets commit the transaction
			this.transactionCommit();

  	}
  	catch (RemoteException re)
  	{
  		this.transactionRollback();
  		throw re;
  	}
  	catch (ApplicationException ae)
  	{
			this.transactionRollback();
  		throw ae;
  	}
  	catch (Throwable t)
  	{
			this.transactionRollback();
  		throw new ApplicationException(Settings.i18n().tr("error while deleting bill"),t);
  	}
  }

  /**
   * @see de.willuhn.datasource.GenericObject#getAttribute(java.lang.String)
   */
  public Object getAttribute(String fieldName) throws RemoteException
  {
		// You are able to create virtual object attributes by overwriting
		// this method. Just catch the fieldName and invent your own attributes ;)
		if ("summary".equals(fieldName))
		{
			return new Double(getPrice() * getEfforts());
		}

    return super.getAttribute(fieldName);
  }

}