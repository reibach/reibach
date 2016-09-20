package reibach.server;

import java.text.DecimalFormat;
import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.text.SimpleDateFormat;
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
import de.willuhn.jameica.system.Application;
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
	// private static Font logo = new Font(Font.FontFamily.HELVETICA, 36, Font.BOLDITALIC );
	// private static Font headline = new Font(Font.FontFamily.HELVETICA, 24, Font.UNDERLINE);
	private static Font subHeadline = new Font(Font.FontFamily.HELVETICA, 16, Font.BOLD);

	private static Font chapter = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	private static Font chapterBold = new Font(Font.FontFamily.HELVETICA , 10, Font.BOLD);
	private static Font chapterBoldUnderline = new Font(Font.FontFamily.HELVETICA , 10, Font.UNDERLINE);
	// private static Font chapterRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);

	
	private static Font normal = new Font(Font.FontFamily.HELVETICA , 10, Font.NORMAL);
	// private static Font normalRed = new Font(Font.FontFamily.HELVETICA, 10, Font.NORMAL, BaseColor.RED);
	
	// private static Font smallBold = new Font(Font.FontFamily.HELVETICA , 8, Font.BOLD);
	private static Font smallFont = new Font(Font.FontFamily.HELVETICA , 8, Font.NORMAL);
	/**
   * @throws RemoteException
   */
	
	// list of positions contained in this bill
	// private TablePart positionListPdf;
	
	// this is the currently opened bill
    // private Bill bill;
	
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
	public Double getStatus() throws RemoteException
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
	 * @see reibach.rmi.Bill("1");
#setStatus(double)
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
  		sum += t.getPrice()*t.getQuantity();
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
	    
	    // String billfile		= "/tmp/RE_" + billnumber + ".pdf";
	    String billfile		= "/home/gm/RE_" + billnumber + ".pdf";
	    
	    // ERROR: country must be checked
	    String country		= "Germany";

	    // Rechnungsdatum 
	    SimpleDateFormat SDF 		= new SimpleDateFormat("dd.MM.yyyy", Application.getConfig().getLocale());	      
	    Date billdate = getBillDate();
	    String MyBillDate = SDF.format(billdate);
		   
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
	    // String mandatorTitle 			= getMandator().getTitle();
	  	String mandatorFirstname 		= getMandator().getFirstname();
	    String mandatorLastname 		= getMandator().getLastname();
	    String mandatorStreet 			= getMandator().getStreet();
	    String mandatorZipcode 			= getMandator().getZipcode();
	    String mandatorHousenumber 		= getMandator().getHousenumber();
	    String mandatorPlace 			= getMandator().getPlace();	    	    
	    String mandatorEmail			= getMandator().getEmail();	    	    
	    String mandatorWebsite			= getMandator().getWebsite();	    	    
	    String mandatorTel 				= getMandator().getTel();	    	    
	    // String mandatorFax 				= getMandator().getFax();	    	    
	    String mandatorMobil 			= getMandator().getMobil();	    	    
	    String mandatorBankname 		= getMandator().getBankname();	    
	    String mandatorBankaccount 		= getMandator().getBankaccount();	    
	    String mandatorBankcodenumber 	= getMandator().getBankcodenumber();	    
	    // String mandatorIban 			= getMandator().getIban();	    
	    // String mandatorBic 				= getMandator().getBic();	    
	    String mandatorTaxoffice 		= getMandator().getTaxoffice();	    
	    String mandatorVatnumber 		= getMandator().getVatnumber();	    
	    String mandatorTaxnumber 		= getMandator().getTaxnumber();	    
	    String mandatorVat				= getMandator().getVat();
	    String mandatorCountry			= country;

	    
		// Geld mit 000,00 und EUR anzeigen 	
	    CurrencyFormatter  MyCF = new CurrencyFormatter(Settings.CURRENCY,Settings.DECIMALFORMAT);

	  
	    
	    DBIterator ipos = getPositions();
		// double quan = 0.00;
		
		while (ipos.hasNext())
	  	{
			Position x  = (Position) ipos.next(); 
			double quan = x.getQuantity();
			System.out.println("Zeile: " + "469" + x);
			System.out.println("Zeile: " + "470" + quan);
			
			double pric = x.getPrice();
			System.out.println("Zeile: " + "473" + pric);
			
			System.out.println(	Settings.i18n().tr("Subtotal") + "475" + MyCF.format(pric));
			


	  	}
	    
	    // Get the Data of Positions	    
	    String posName 			= "";
	    double posQuantity 		= 0;
	    String posUnit 			= "";
	  	double posPrice 		= 0;
	    
	  	String posPos_num 		= "";
	  	
	  	String posComment 		= "";
	    // String posTax 			= "";
	    double posAmount 		= 0;
	    
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

	    Double posEfforts 		= getEfforts();
	  	String effortSummary = posEfforts.toString();
		System.out.println("Zeile: " + "502");
	  	
 	
	  	try
	  	{

		  	/*
	  	   * Getting some fonts
	  	   */
	        BaseFont bf_helv_bold = BaseFont.createFont(BaseFont.HELVETICA_BOLD, "Cp1252", false);
	        BaseFont bf_helv = BaseFont.createFont(BaseFont.HELVETICA, "Cp1252", false);
	        BaseFont bf_helv_obl = BaseFont.createFont(BaseFont.HELVETICA_OBLIQUE, "Cp1252", false);
	        // BaseFont bf_helvbold_obl = BaseFont.createFont(BaseFont.HELVETICA_BOLDOBLIQUE, "Cp1252", false);

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
			  
            // START
		    // cust.add(new Paragraph(mandatorCompany + " " + mandatorCompany, normal));	
            
            // Daten des Mandanten als Kopf
            Paragraph manTitle = new Paragraph();
    		manTitle.add(new Paragraph(mandatorCompany, subHeadline));
    		// manTitle.add(new Paragraph("______", headline));
    		
    		// if (mandatorVat.equals("not")) { 
    		if (!mandatorSlogan.isEmpty()) {
        		manTitle.add(new Paragraph(mandatorSlogan, subHeadline));   			
    		};
    			
    		manTitle.add(new Paragraph(mandatorFirstname  + " " + mandatorLastname, normal));
    		manTitle.add(new Paragraph(mandatorStreet + " " + mandatorHousenumber, normal));
    		manTitle.add(new Paragraph(mandatorZipcode + " " + mandatorPlace, normal));
    		// manTitle.add(new Paragraph("mandatorVat: " + mandatorVat, normal));
    		    		
			addEmptyLine(manTitle, 2);
    		document.add(manTitle);	

            
            // END

            
            
            // Autor, Eigenschaften des Dokumentes   
            // if (mandatorCompany == "federa") {
            	// addMetaData(document);
    			// Logo, Slogan
    			// addMandatoryTitle(document);			
            // }
			System.out.println("Zeile: " + "564");

			 
			/* BUG: Nur wenn für jede Zeile ein Object erzeugt wird, klappt es mit der Rechtsausrichtung,
			 * war mal anders, hier der ursprüngliche Code
			
			Paragraph billData = new Paragraph();
			billData.add(new Paragraph(Settings.i18n().tr("Bill"), subHeadline));
			billData.add(new Paragraph(Settings.i18n().tr("Bill number") + ": " + billnumber, normal));
			billData.add(new Paragraph(Settings.i18n().tr("Customer number") + ": " + customerID, normal));	
		    billData.add(new Paragraph(Settings.i18n().tr("Bill date")  + ": " +  MyBillDate , normal));
			addEmptyLine(billData, 2);
			
			// We add one empty line
			addEmptyLine(billData, 2);
			billData.setAlignment(Element.ALIGN_RIGHT);
			
			// writing 
			document.add(billData);
			
			ENDE BUG */ 
			
			// Rechnungsnummer, Rechnungsdatum 
			Paragraph p1 = new Paragraph(Settings.i18n().tr("Bill"), subHeadline);
		    p1.setAlignment(Element.ALIGN_RIGHT);
		    document.add(p1);
		    
			Paragraph p2 = new Paragraph(Settings.i18n().tr("Bill number") + ": " + billnumber, normal);
		    p2.setAlignment(Element.ALIGN_RIGHT);
		    document.add(p2);
				
			Paragraph p3 = new Paragraph(Settings.i18n().tr("Customer number") + ": " + customerID, normal);
		    p3.setAlignment(Element.ALIGN_RIGHT);
		    document.add(p3);
				
			Paragraph p4 = new Paragraph(Settings.i18n().tr("Bill date")  + ": " +  MyBillDate , normal);
		    p4.setAlignment(Element.ALIGN_RIGHT);
		    document.add(p4);
				
			
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
	    
		    PdfPTable table = new PdfPTable(6);

			table.setWidthPercentage(100);
			table.setTotalWidth(new float[]{ 30,40,40,230,70,110 });
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
			
//			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("VAT"), chapterBold));
//			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
//			table.addCell(c1);

			c1 = new PdfPCell(new Phrase(Settings.i18n().tr("Total price"), chapterBold));
			c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
			table.addCell(c1);
				
			
			table.setHeaderRows(1);
			
			// pos.add(new Paragraph("POSPLACE" + posPlace));

		    pos.add(new Paragraph("SUM" + effortSummary));
			System.out.println("Zeile: " + "632");


			
			DBIterator positionListPdf = getPositions();

			// String a;
			while (positionListPdf.hasNext())
		  	{
		  		Position t = (Position) positionListPdf.next();

		  		
				System.out.println("Zeile: " + "646");
		  		// Pos Nummer
		  		posPos_num 	= t.getPos_num() + " ";
		  		
		  		// posPos_num 	= "666";
				System.out.println("Zeile: " + "649");

		  		// WORKAROUND --> START #############################################################################
			  		
		  		posPrice = t.getPrice();
		  		
		  		// Menge
		  		posQuantity = t.getQuantity();
		  		
		  		String posQuantityString = String.valueOf(posQuantity);
		  		System.out.println("Zeile: " + "668");
		  		System.out.println(posQuantityString);

		  		
		  		// Einheit
		  		posUnit 	= t.getUnit();
		  		
		  		// Bescheibung
		  		posName 	= t.getName();

		  		// Einzelpreis (brutto)
	  			posPrice 	= t.getPrice();		  		
			  	
		  		// Steuer (jeweils)
	  			// posTax		= t.getTax() + " ";

		  		// Gescamtpreis je Position
	  			posAmount 	= t.getAmount();		  		
		  		
	  			
	  			// Zwischensumme (brutto)
		  		posTotal		+= Double.parseDouble(t.getAmount() + " ");
		  		posTotalStr		= posTotal + " ";		  		
		  		
		  		
		  		// Mehrwertsteuer (gesamt)
		  		
		  		posTaxtotal		+= Double.parseDouble(t.getTax() + " ");
		  		posTaxtotalStr	= posTaxtotal + " ";
		  		
		  		// Nettobetrag (gesamt)
		  		posNetamount	= posTotal - posTaxtotal;
		  		posNetamountStr	= posNetamount + " ";		  		
				System.out.println("Zeile: " + "688");

		  		
		  		/**********
		  		
		  		********/
		  		// WORKAROUND --> ENDE  #############################################################################
		  		
		  		
		  		// posSubtotal	= Double.parseDouble(posAmount);
		  		
		  		
		  		String posPos_num_Str = String.valueOf(posPos_num);
		  		c1 = new PdfPCell(new Phrase(posPos_num_Str, chapter));
		  		table.addCell(c1);
				
		  		String posQuantity_Str = String.valueOf(posQuantity);
		  		
		  		c1 = new PdfPCell(new Phrase(posQuantity_Str, chapter));
				table.addCell(c1);

				c1 = new PdfPCell(new Phrase(posUnit, chapter));
				table.addCell(c1);

				c1 = new PdfPCell(new Phrase(posName, chapter));
				table.addCell(c1);
				
				c1 = new PdfPCell(new Phrase(MyCF.format(posPrice), chapter));
				// price.setComment(Settings.i18n().tr("Hours [example: enter \"0,5\" to store 30 minutes]"));
				
				c1.setHorizontalAlignment(Element.ALIGN_RIGHT);

				table.addCell(c1);	

				// c1 = new PdfPCell(new Phrase(posTax + " €", chapter));
				// c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
				// table.addCell(c1);	

				c1 = new PdfPCell(new Phrase(MyCF.format(posAmount), chapterBold));
				c1.setHorizontalAlignment(Element.ALIGN_RIGHT);
				table.addCell(c1);	

		  	
		  	} // ENDE while
			
			System.out.println("Zeile: " + "727");

			
			document.add(table);

			// Zwischensumme
			Paragraph p_subtotal = new Paragraph(Settings.i18n().tr("Subtotal")+ ": " + MyCF.format(posTotal), chapterBoldUnderline);
			p_subtotal.setAlignment(Element.ALIGN_RIGHT);
			document.add(p_subtotal);
						
			// Gesamtsumme
			Paragraph p_amount = new Paragraph(Settings.i18n().tr("Amount gross")+ ": " + MyCF.format(posTotal), chapterBold);
			p_amount.setAlignment(Element.ALIGN_RIGHT);
			document.add(p_amount);
						
			// unterstrichen
			Paragraph p_underline = new Paragraph(Settings.i18n().tr("========================="), chapterBold);
			p_underline.setAlignment(Element.ALIGN_RIGHT);
			document.add(p_underline);
						
						
			  // Zwischensumme (brutto)
			Paragraph space = new Paragraph();
			addEmptyLine(space, 2);
			space.setAlignment(Element.ALIGN_RIGHT);
			

			// space.add(new Paragraph("Zwischensumme (brutto):  " +  posSubtotalStr + " €", chapterBoldUnderline));
			// space.add((new Phrase(Settings.i18n().tr("Subtotal")+ ": " + MyCF.format(posTotal), chapterBoldUnderline)));
			// space.add(new Paragraph(new Phrase(Settings.i18n().tr("Amount gross")+ ": " + MyCF.format(posTotal), chapterBold)));
			// space.add(new Paragraph("=========================" , chapterBold));
			document.add(space);
			
			// Rechnungskommentar: Zahlweise und allg. Beschreibung(en) 
			// unterstrichen
			Paragraph p_billcomment = new Paragraph(Settings.i18n().tr(billcomment), chapterBold);
			// p_billcomment.setAlignment(Element.ALIGN_RIGHT);
			document.add(p_billcomment);
			
			// addEmptyLine(space, 2);
			document.add(space);

			// Der Rechnungsbetrag ist ohne Abzug fällig innerhalb von 10 Tagen nach Erhalt der Rechnung.
			// unterstrichen
			Paragraph p_paylimit = new Paragraph(Settings.i18n().tr("Der Rechnungsbetrag ist ohne Abzug fällig innerhalb von 10 Tagen nach Erhalt der Rechnung."), chapterBold);
			// p_paylimit.setAlignment(Element.ALIGN_RIGHT);
			document.add(p_paylimit);			
			
			document.add(space);			
			
			Paragraph P_Tax = new Paragraph(Settings.i18n().tr("Als Kleinunternehmer im Sinne von § 19 Abs. 1 UStG wird Umsatzsteuer nicht berechnet!"), chapterBold);
			// P_Tax.setAlignment(Element.ALIGN_RIGHT);
			
			// Tax.add(new Paragraph("mandatorVat: " + mandatorVat, normal));
   		 	
	    	// Steuer oder nicht 
		    if (mandatorVat.equals("not")) { 
				document.add(P_Tax);
		    } else {
				document.add(new Paragraph("Else will nix", chapterBold));		    
		    };

		    
		    
			// Start FOOTER , Daten des Mandanten
			// add text at an absolute position
			PdfContentByte cb = writer.getDirectContent();
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
			cb.setTextMatrix(160, 20);
			cb.showText(mandatorWebsite);
			cb.setTextMatrix(160, 30);
			cb.showText(mandatorEmail);
			cb.setTextMatrix(160, 40);
			cb.showText(mandatorMobil);
			cb.setTextMatrix(160, 50);
			cb.showText(mandatorTel);
            
            cb.setTextMatrix(350, 20);
            cb.showText(mandatorBankcodenumber);
            cb.setTextMatrix(350, 30);
            cb.showText(mandatorBankaccount);
            cb.setTextMatrix(350, 40);
            cb.showText(mandatorBankname);
            cb.setTextMatrix(350, 50);
            // cb.showText(Settings.i18n().tr("Bank"+" @ "+" € "));
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

			             
	      document.close();
	      file.close();
	  	} catch (Exception e) {
			throw new ApplicationException(Settings.i18n().tr("error while printing the bill in /home/gm/ from serverBillImpl.java "),e);
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

		private static void addEmptyLine(Paragraph paragraph, int number) {
			for (int i = 0; i < number; i++) {
				paragraph.add(new Paragraph(" "));
			}
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

@Override
public void setStatus(Double status) throws RemoteException {
	// TODO Automatisch generierter Methodenstub
	
}
}