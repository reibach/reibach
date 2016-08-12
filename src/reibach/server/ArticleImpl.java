package reibach.server;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Article;
import reibach.rmi.Mandator;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Implementation of the article interface.
 * Look into ProjectImpl for more code comments.
 */
public class ArticleImpl extends AbstractDBObject implements Article
{

  /**
   * ct.
   * @throws RemoteException
   */
  public ArticleImpl() throws RemoteException
  {
    super();
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
   */
  protected String getTableName()
  {
  	// this is the sql table name.
    return "article";
  }

  /**
   * @see de.willuhn.datasource.GenericObject#getPrimaryAttribute()
   */
  public String getPrimaryAttribute() throws RemoteException
  {
  	// our primary attribute is the name.
    return "name";
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#deleteCheck()
   */
  protected void deleteCheck() throws ApplicationException
  {
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#insertCheck()
   */
  protected void insertCheck() throws ApplicationException
  {
		try {
			if (getName() == null || getName().length() == 0)
				throw new ApplicationException(Settings.i18n().tr("Please enter a article name"));

		}
		catch (RemoteException e)
		{
			Logger.error("insert check of project failed",e);
			throw new ApplicationException(Settings.i18n().tr("unable to store project, please check the system log"));
		}
  }

  
  /**
   * Liefert den Inhalt der Datei.
   * @return Inhalt der Datei.
   * @throws RemoteException
   */
  public byte[] getData() throws RemoteException
  {
    return (byte[]) this.getAttribute("data");
  }
 
  /**
   * Speichert den Inhalt der Datei.
   * @param data Inhalt der Datei.
   * @throws RemoteException
   */
  public void setData(byte[] data) throws RemoteException
  {
    setAttribute("data",data);
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#updateCheck()
   */
  protected void updateCheck() throws ApplicationException
  {
  	// same as insertCheck
  	insertCheck();
  }

  /**
   * @see reibach.rmi.Article#getName()
   */
  public String getName() throws RemoteException
  {
    return (String) getAttribute("name");
  }

  /**
   * @see reibach.rmi.Article#setName(java.lang.String)
   */
  public void setName(String name) throws RemoteException
  {
  	setAttribute("name",name);
  }

  /**
   * @see reibach.rmi.Article#getComment()
   */
  public String getComment() throws RemoteException
  {
    return (String) getAttribute("comment");
  }
 
  /**
   * @see reibach.rmi.Article#setComment(java.lang.String)
   */
  public void setComment(String comment) throws RemoteException
  {
  	setAttribute("comment",comment);
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
	 * @see reibach.rmi.Bill#setMandator(java.lang.String)
	 */
	public void setMandator(Mandator mandator) throws RemoteException
	{
  // Please use setField(<fieldname>,<value>) to store the data into the right field.
  	setAttribute("mandator_id",mandator);
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
   * @see reibach.rmi.Article#getEffort()
   */
  public double getEffort() throws RemoteException
  {
    Double d = (Double) getAttribute("effort");
    return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
  }

  /**
   * @see reibach.rmi.Article#getUnit()
   */
  public String getUnit() throws RemoteException
  {
    return (String) getAttribute("unit");
  }

  /**
   * @see reibach.rmi.Article#setUnit(java.lang.String)
   */
  public void setUnit(String unit) throws RemoteException
  {
  	setAttribute("unit", unit);
  }



  
  /**
   * @see reibach.rmi.Article#getArticles()
   */
	public DBIterator getArticles() throws RemoteException
	{
		try
  {
    // 1) Get the Database Service.
    DBService service = this.getService();

    // you can get the Database Service also via:
    // DBService service = this.getService();
    
    // 3) We create the task list using getList(Class)
    DBIterator articles = service.createList(Article.class);
        
    return articles;
  }
  catch (Exception e)
  {
  	throw new RemoteException("unable to load article list",e);
  }
	}
	
	 /**
	   * @see reibach.rmi.Task#setEffort(double)
	   */
	  public void setEffort(double effort) throws RemoteException
	  {
	  	setAttribute("effort", new Double(effort));
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
}
