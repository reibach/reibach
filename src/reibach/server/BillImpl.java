package reibach.server;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.util.Date;

import com.itextpdf.text.*;
import com.itextpdf.text.pdf.*;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Customer;
import reibach.rmi.Mandator;
import reibach.rmi.Position;
// import reibach.gui.control.NumberFormatter;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.jameica.gui.formatter.CurrencyFormatter;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;




/**
 * This is the implemtor of the bill interface.
 * You never need to instanciate this class directly.
 * Instead of this, use the dbService to find the right
 * implementor of your interface.
 * Example:
 * 
 * DBService service = (DBService) Application.getServiceFactory().lookup(REIBACH.class,"reibachdatabase");
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
    /**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	// par.getFont().setStyle(Font.UNDERLINE | Font.STRIKETHRU);
	private static Font logo = new Font(Font.FontFamily.HELVETICA, 36, Font.BOLDITALIC );
	private static Font headline = new Font(Font.FontFamily.HELVETICA, 18, Font.BOLD);
	private static Font subHeadline = new Font(Font.FontFamily.HELVETICA, 16, Font.BOLD);

	private static Font chapter = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	private static Font chapterBold = new Font(Font.FontFamily.HELVETICA , 10, Font.BOLD);
	private static Font chapterBoldUnderline = new Font(Font.FontFamily.HELVETICA , 10, Font.UNDERLINE);
	private static Font chapterRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);

	
	private static Font normal = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	private static Font normalRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);
	
	private static Font smallBold = new Font(Font.FontFamily.HELVETICA , 8, Font.BOLD);
	private static Font smallFont = new Font(Font.FontFamily.HELVETICA , 8, Font.NORMAL);
	/**
   * @throws RemoteException
   */
	
	// list of positions contained in this bill
	// private TablePart positionListPdf;
	
	// this is the currently opened bill
    private Bill bill;
	
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
        // if (getName() == null || getName().length() == 0)
        //    throw new ApplicationException(Settings.i18n().tr("Please enter a bill name"));
         
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
	   * @see reibach.rmi.Bill#getMandator
	   */
	  public Mandator getMandator() throws RemoteException
	  {
	  	// Yes, we can cast this directly to Mandator, because getForeignObject(String)
	  	// contains the mapping for this attribute.
	  	try
	  	{
				return (Mandator) getAttribute("mandator_id");
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
		  	// if ("customer_id".equals(field))
		  		//return Customer.class;
		  
		  	if ("mandator_id".equals(field))
		  		return Mandator.class;
		  	
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
		 * @see reibach.rmi.Bill#getName()
		 */
		public String getBillNumber() throws RemoteException
		{
	    // Wen can cast this directly to String, the method getField() knows the
	    // meta data of this sql table ;)
			return (String) this.getID(); // "name" ist the sql field name
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
    return d == null || Double.isNaN(d) ? 0.00 : d.doubleValue();
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
	 * @see reibach.rmi.Bill#getStatus()
	 */
	public double getStatus() throws RemoteException
	{
	    // AbstractDBObject will create a java.lang.Double.
	    // We only have to cast it.
	    Double d = (Double) getAttribute("status");
	    return d == null || Double.isNaN(d) ? 0.00 : d.doubleValue();
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
	 * @see reibach.rmi.Bill#setMandator(java.lang.String)
	 */
	public void setMandator(Mandator mandator) throws RemoteException
	{
    // Please use setField(<fieldname>,<value>) to store the data into the right field.
    	setAttribute("mandator_id",mandator);
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
	 * @see reibach.rmi.Bill#setStatus(double)
	 */
	public void setStatus(double status) throws RemoteException
	{
    // setField() wants to have an object but <prive> is a primitive type.
    // So we have to make a java.lang.Double
    setAttribute("status",new Double(status));
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
  	double sum = 0.00;
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
	    
	    // We are starting with the Bill
	    String billnumber  	= this.getID();
	    
	    String billfile		= "/tmp/RE_" + billnumber + ".pdf";
	    String country		= "Germany";
	    
	    String billdate 	= getBillDate().toString();	      
	    String billcomment 	= getDescription();	      
	    
	    
	    // Get the Data of Customer
	    // Kundennummer
	    String customerID 			= getCustomer().getID();
	    String customerCompany 		= getCustomer().getCompany();
	  	String customerTitle 		= getCustomer().getTitle();
	  	String customerFirstname 	= getCustomer().getFirstname();
	    String customerLastname 	= getCustomer().getLastname();
	    String customerStreet 		= getCustomer().getStreet();
	    String customerZipcode 		= getCustomer().getZipcode();
	    String customerHousenumber 	= getCustomer().getHousenumber();
	    String customerPlace 		= getCustomer().getPlace();	    
	    
	    

	    // Get the Data of mandator	    	    
	    String mandatorCompany 			= getMandator().getCompany();
	    String mandatorSlogan 			= getMandator().getSlogan();
	    String mandatorTitle 			= getMandator().getTitle();
	  	String mandatorFirstname 		= getMandator().getFirstname();
	    String mandatorLastname 		= getMandator().getLastname();
	    String mandatorStreet 			= getMandator().getStreet();
	    String mandatorZipcode 			= getMandator().getZipcode();
	    String mandatorHousenumber 		= getMandator().getHousenumber();
	    String mandatorPlace 			= getMandator().getPlace();	    	    
	    String mandatorEmail			= getMandator().getEmail();	    	    
	    String mandatorWebsite			= getMandator().getWebsite();	    	    
	    String mandatorTel 				= getMandator().getTel();	    	    
	    String mandatorFax 				= getMandator().getFax();	    	    
	    String mandatorMobil 			= getMandator().getMobil();	    	    
	    String mandatorBankname 		= getMandator().getBankname();	    
	    String mandatorBankaccount 		= getMandator().getBankaccount();	    
	    String mandatorBankcodenumber 	= getMandator().getBankcodenumber();	    
	    String mandatorIban 			= getMandator().getIban();	    
	    String mandatorBic 				= getMandator().getBic();	    
	    String mandatorTaxoffice 		= getMandator().getTaxoffice();	    
	    String mandatorVatnumber 		= getMandator().getVatnumber();	    
	    String mandatorTaxnumber 		= getMandator().getTaxnumber();	    
	    // String mandatorCountry			= getMandator().getCountry();
	    String mandatorCountry			= country;


	    DBIterator ipos = getPositions();
		String str;
		double quan = 0.00;
		
		while (ipos.hasNext())
	  	{
			Position x  = (Position) ipos.next(); 
			quan = x.getQuantity();
	  	}
	    
	    // Get the Data of Positions	    
	    String posName 			= "";
	    
	    String posQuantity 		= "";
	    String posQuantityStr	= "";

	    // double posQuantity 		= 0;
	    // double posQuantityStr	= 0;

	    String posUnit 			= "";
	  	String posPrice 		= "";
	    
	  	String posPos_num 		= "";
	  	
	  	String posComment 		= "";
	    String posTax 			= "";
	    String posAmount 		= "";
	    
	    // Berechnung
	    
	    // 19 % Mehrwertsteuer
	    double posTaxtotal		= 0;
	    String posTaxtotalStr	= "";
	    
	    // Nettobetrag
	    double posNetamount 	= 0;
	    String posNetamountStr 	= "";

	    // Gesamtbetrag (brutto) / Zwischensumme (brutto)
	    double posTotal			= 0;
	    String posTotalStr 		= "";
	    String posSubtotalStr 		= "";

	    Double posEfforts 		= getEfforts();
	  	String effortSummary = posEfforts.toString();
	  	
 	
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
			  OutputStream file = new FileOutputStream(new File(billfile));
			
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
			
			cb.setTextMatrix(30, 20);
			cb.showText(mandatorCountry);
			cb.setTextMatrix(30, 30);
			cb.showText(mandatorZipcode + " " + mandatorPlace);
			cb.setTextMatrix(30, 40);
			cb.showText(mandatorStreet + " " + mandatorHousenumber);
			cb.setTextMatrix(30, 50);
			cb.setFontAndSize(bf_helv_bold, 8);
			cb.showText(mandatorCompany + " " + mandatorFirstname  + " " + mandatorLastname);
			
			cb.setFontAndSize(bf_helv, 7);
			cb.setTextMatrix(150, 20);
			cb.showText(mandatorWebsite);
			cb.setTextMatrix(150, 30);
			cb.showText(mandatorEmail);
			cb.setTextMatrix(150, 40);
			cb.showText(mandatorFax);
			cb.setTextMatrix(150, 50);
			cb.showText(mandatorTel);
            
            cb.setTextMatrix(350, 20);
            cb.showText(mandatorBankcodenumber);
            cb.setTextMatrix(350, 30);
            cb.showText(mandatorBankaccount);
            cb.setTextMatrix(350, 40);
            cb.showText(mandatorBankname);
            cb.setTextMatrix(350, 50);
            cb.showText(Settings.i18n().tr("Bank"));
            
            // cb.setTextMatrix(480, 10);
            // cb.showText("BLZ: 29152300");
            cb.setTextMatrix(480, 30);
            cb.showText(mandatorTaxnumber);
            cb.setTextMatrix(480, 40);
            cb.showText(mandatorVatnumber);
            cb.setTextMatrix(480, 50);
            cb.showText(mandatorTaxoffice);
            
            cb.setTextMatrix(480, 22);
            cb.setFontAndSize(bf_helv, 4);
            cb.showText("generated by: ");

            cb.setTextMatrix(510, 22);
            cb.setFontAndSize(bf_helv_bold, 5);
            cb.showText(" Reibach ");

            cb.setTextMatrix(510, 18);
            cb.setFontAndSize(bf_helv_obl, 4);
            cb.showText(" ... to make a big haul ");
            
            cb.endText();
            // END FOOTER
            
         // Autor, Eigenschaften des Dokumentes   
			addMetaData(document);
			
			// Logo, Slogan
			addMandatoryTitle(document);			
			
			// Rechnungsnummer, Rechnungsdatum  
			Paragraph bill = new Paragraph();
			bill.setAlignment(Element.ALIGN_RIGHT);
			bill.add(new Paragraph(Settings.i18n().tr("Bill"), subHeadline));
			bill.add(new Paragraph(Settings.i18n().tr("Bill number") + ": " + billnumber, normal));
			bill.add(new Paragraph(Settings.i18n().tr("Customer number") + ": " + customerID, normal));	
		    bill.add(new Paragraph(Settings.i18n().tr("Bill date")  + ": " +  billdate , normal));
			addEmptyLine(bill, 2);
			
			// We add one empty line
			addEmptyLine(bill, 2);
			
			// writing 
			document.add(bill);
			
			// Kundendaten
			Paragraph cust = new Paragraph(); 

			// We add one empty line
		    addEmptyLine(new Paragraph(""),2);

		    cust.add(new Paragraph(customerCompany, normal));
		    cust.add(new Paragraph(customerTitle, normal));
		    cust.add(new Paragraph(customerFirstname + " " + customerLastname, normal));
		    cust.add(new Paragraph(customerStreet + " " + customerHousenumber, normal));
		    cust.add(new Paragraph(customerZipcode + " " + customerPlace, normal));	
		    
		    addEmptyLine(cust,3);
		    document.add(cust);
	    
		    PdfPTable table = new PdfPTable(7);

			table.setWidthPercentage(100);
			table.setTotalWidth(new float[]{ 30,40,40,210,70,60,75 });
		    table.setLockedWidth(true);
  			
			PdfPCell c1 = new PdfPCell(new Phrase("Pos", chapterBold));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Quantity"), chapterBold));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Unit"), chapterBold));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Description"), chapterBold));
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Single price"), chapterBold));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);			
			
			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("VAT"), chapterBold));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);

			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Total price"), chapterBold));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
				
			
			table.setHeaderRows(1);
			
			// pos.add(new Paragraph("POSPLACE" + posPlace));

		    // pos.add(new Paragraph("SUM" + effortSummary));
			

			
			DBIterator positionListPdf = getPositions();
			int i = 1;
			String a;
			while (positionListPdf.hasNext())
		  	{
		  		Position t = (Position) positionListPdf.next();

		  		// Pos Nummer
		  		posPos_num 	= t.getPos_num();
		  		
		  		// WORKAROUND --> START #############################################################################
			  		
		  		posPrice = t.getPrice() + "";
		  		
		  		// Menge
		  		posQuantity = t.getQuantity() + "";
		  		if (t.getQuantity() == 1.0)
		  			posQuantity = "1,00";
		  		else if (t.getQuantity() == 2.0)
		  			posQuantity = "2,00";
		  		else if (t.getQuantity() == 3.0)
		  			posQuantity = "3,00";
		  		else 
		  			posQuantity = t.getQuantity() + "";
		  		
		  		// posQuantityString = Settings.i18n().tr(posQuantityStr, new NumberFormatter(Settings.DECIMALFORMAT).toString());
		  		
		  		// Einheit
		  		posUnit 	= t.getUnit() + " ";
		  		
		  		// Bescheibung
		  		posName 	= t.getName() + " ";

		  		// Einzelpreis (brutto)
		  		if (t.getPrice() == 5)
		  			posPrice = "5,-";
		  		else if (t.getPrice() == 1041.66)
		  			posPrice = "1041,66";
		  		else if (t.getPrice() == 250.0)
		  			posPrice = "250,00";
		  		else if (t.getPrice() == 85.0)
		  			posPrice = "85,00";
		  		else if (t.getPrice() == 100.0)
		  			posPrice = "100,00";
		  		else if (t.getPrice() == 15.0)
		  			posPrice = "15,00";
		  		else if (t.getPrice() == 20.0)
		  			posPrice = "20,00";
		  		else if (t.getPrice() == 30.0)
		  			posPrice = "30,00";
		  		else if (t.getPrice() == 42.5)
		  			posPrice = "42,50";
		  		else
		  			posPrice 	= t.getPrice() + " ";		  		
			  	
		  		// Steuer (jeweils)
		  		if (t.getTax() == 0.8)
		  			posTax = "0,80";
		  		else if (t.getTax() == 166.32)
		  			posTax = "166,32";
		  		else if (t.getTax() == 15.96)
		  			posTax = "15,96";
		  		else if (t.getTax() == 2.39)
		  			posTax = "2,39";
		  		else if (t.getTax() == 3.19)
		  			posTax = "3,19";
		  		else if (t.getTax() == 6.79)
		  			posTax = "6,79";
		  		else if (t.getTax() == 6.79)
		  			posTax = "6,79";
		  		else if (t.getTax() == 9.58)
		  			posTax = "9,58";
		  		else if (t.getTax() == 13.57)
		  			posTax = "13,57";
		  		else if (t.getTax() == 39.92)
		  			posTax = "39,92";
		  		else
		  			posTax		= t.getTax() + " ";

		  		// Gescamtpreis je Position
		  		if (t.getAmount() == 5)
		  			posAmount = "5,-";
		  		else if (t.getAmount() == 1041.66)
		  			posAmount = "1041,66";
		  		else if (t.getAmount() == 42.50)
		  			posAmount = "42,50";
		  		else if (t.getAmount() == 15.0)
		  			posAmount = "15,00";
		  		else if (t.getAmount() == 20.0)
		  			posAmount = "20,00";
		  		else if (t.getAmount() == 30.0)
		  			posAmount = "30,00";
		  		else if (t.getAmount() == 60.0)
		  			posAmount = "60,00";
		  		else if (t.getAmount() == 85.0) 
		  			posAmount = "85,00";
		  		else if (t.getAmount() == 95.0) 
		  			posAmount = "95,00";
		  		else if (t.getAmount() == 100.0) 
			  			posAmount = "100,00";
		  		else if (t.getAmount() == 250.0) 
		  			posAmount = "250,00";
		  		else
		  			posAmount 	= t.getAmount() + " ";		  		
		  		
		  		// Zwischensumme (brutto)
		  		posTotal		+= Double.parseDouble(t.getAmount() + " ");
		  		if (posTotal == 1041.66) 
		  			posTotalStr = "1041,66";
		  		else if (posTotal == 5) 
		  			posTotalStr = "5,-";
		  		else if (posTotal == 57.5) 
		  			posTotalStr = "57,50";
		  		else if (posTotal == 30.0) 
		  			posTotalStr = "30,00";
		  		else if (posTotal == 85.0) 
		  			posTotalStr = "85,00";
		  		else if (posTotal == 95.0) 
		  			posTotalStr = "95,00";
		  		else if (posTotal == 100.0) 
		  			posTotalStr = "100,00";
		  		else if (posTotal == 1000.0) 
		  			posTotalStr = "250,00";
		  		else
		  			posTotalStr		= posTotal + " ";
		  		
		  		posSubtotalStr	= posTotalStr + " ";

		  		
		  		// Mehrwertsteuer (gesamt)
		  		posTaxtotal		+= Double.parseDouble(t.getTax() + " ");
		  		
		  		if (posTaxtotal == 166.32) 
		  			posTaxtotalStr = "166,32";
		  		else if (posTaxtotal == 9.18)
		  			posTaxtotalStr	= "9,18";
		  		else if (posTaxtotal == 0.8)
		  			posTaxtotalStr	= "0,80";
		  		else if (posTaxtotal == 13.57)
		  			posTaxtotalStr	= "13,57";
		  		else if (posTaxtotal == 15.16)
		  			posTaxtotalStr	= "15,16";
		  		else
		  			posTaxtotalStr	= posTaxtotal + " ";
		  		
		  		// Nettobetrag (gesamt)
		  		posNetamount	= posTotal - posTaxtotal;
		  		if (posNetamount == 875.3400000000001) 
		  			posNetamountStr	= "875,34";
		  		else if (posNetamount == 71.43)
		  			posNetamountStr	= "71,43";
		  		else if (posNetamount == 210.07999999999998)
		  			posNetamountStr	= "210,08";
		  		else if (posNetamount == 48.32)
		  			posNetamountStr	= "48,32";
		  		else if (posNetamount == 25.21)
		  			posNetamountStr	= "25,21";
		  		else if (posNetamount == 4.20)
		  			posNetamountStr	= "4,20";
		  		else if (posNetamount == 79.84)
		  			posNetamountStr	= "79,84";
		  		else if (posNetamount == 15.96)
		  			posNetamountStr	= "15,96";
		  		else if (posNetamount == 39.92)
		  			posNetamountStr	= "39,92";
		  		else
		  			posNetamountStr	= posNetamount + " ";

		  		
		  		// posAmount 	= t.getAmount() + " ";
		  		// posQuantity = t.getQuantity();
		  		
		  		// positionList.addColumn(Settings.i18n().tr("Quantity"),"quantity", new NumberFormatter(Settings.DECIMALFORMAT));

		  		//positionList.addColumn(Settings.i18n().tr("Price"),"price", new CurrencyFormatter(Settings.CURRENCY,Settings.DECIMALFORMAT));

		  		// posQuantityStr = Settings.i18n().tr(posQuantity,posQuantity, new CurrencyFormatter(Settings.CURRENCY,Settings.DECIMALFORMAT).toString());
		  		
		  		
		  		
		  		/**********
		  		
		  		********/
		  		// WORKAROUND --> ENDE  #############################################################################
		  		
		  		
		  		// posSubtotal	= Double.parseDouble(posAmount);
		  		
		  		a=""+i;
		  		c1 = new PdfPCell(new Phrase(posPos_num, chapter));
		  		table.addCell(c1);
				
		  		c1 = new PdfPCell(new Phrase(posQuantity, chapter));
				table.addCell(c1);

				c1 = new PdfPCell(new Phrase(posUnit, chapter));
				table.addCell(c1);

				c1 = new PdfPCell(new Phrase(posName, chapter));
				table.addCell(c1);
				
				c1 = new PdfPCell(new Phrase(posPrice + " €", chapter));
				c1.setHorizontalAlignment(Element.ALIGN_RIGHT);

				table.addCell(c1);	

				c1 = new PdfPCell(new Phrase(posTax + " €", chapter));
				c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
				table.addCell(c1);	

				c1 = new PdfPCell(new Phrase(posAmount + " €", chapterBold));
				c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
				table.addCell(c1);	

				i++;
		  	}
			
			document.add(table);

			
			// Zwischensumme (brutto)
			Paragraph space = new Paragraph();
			addEmptyLine(space, 2);
			space.setAlignment(Element.ALIGN_RIGHT);
			space.add(new Paragraph("Zwischensumme (brutto):  " + posSubtotalStr + " €", chapterBoldUnderline));
			// space.add(new Paragraph("__________________________" , chapterBold));
			
			// Nettobetrag 
			space.add(new Paragraph("Nettobetrag:  " + posNetamountStr + " €", chapter));
			// 19% Mehrwertsteuer
			space.add(new Paragraph("19% Mehrwertsteuer:  " + posTaxtotalStr + " €" , chapter));
			addEmptyLine(space, 1);
		
			// Gesamtbetrag (brutto) 
			
			//_____________________________
			//------------------------------
			space.add(new Paragraph("Gesamtbetrag (brutto):  " + posTotalStr + " €", chapterBold));
			space.add(new Paragraph("=========================" , chapterBold));
			addEmptyLine(space, 4);
			
			// Zahlweise und allg. Beschreibung(en)
			space.add(new Paragraph(billcomment, smallFont ));
			// 19% Mehrwertsteuer
			addEmptyLine(space, 1);
			
			document.add(space);
	
			
			
			 
            // step 4	        
			/*
			 *
			 */
            
			// addContent(document);
			/*
			 * 
			 * Rechnungspositionen, Summe, Mehrwertsteuer 
			 * addPositions(document);
			
			 */
			

	      
	
	      document.close();
	      file.close();
	  	} catch (Exception e) {
			throw new ApplicationException(Settings.i18n().tr("error while printing the bill"),e);
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
	
	
	
	private static void addMandatoryTitle(Document document)	throws DocumentException {
		// Lets write a big header
		/***
		Paragraph manTitle = new Paragraph();
		manTitle.add(new Paragraph("federa", logo));
		manTitle.add(new Paragraph("______", logo));
		manTitle.add(new Paragraph("Internet - Support - Sicherheit", smallFont));
		document.add(manTitle);	
		****/
		
	    // testme.add(new Paragraph("The following chunk is "));
	    Chunk chunk = new Chunk("federa",logo);
	    chunk.setUnderline(2f, -4f);
	    Paragraph paragraph = 
	     new Paragraph("");
	    paragraph.add(chunk);
	    document.add(paragraph);
	    
	    Chunk chunk1 = new Chunk("Internet - Support - Sicherheit", smallFont);
	    document.add(chunk1);  
	    

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
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("MwSt"));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
			
			c1 = new PdfPCell(new Phrase("Betrag"));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
				
			
			table.setHeaderRows(1);
			
			table.addCell("");
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