package reibach.server;
import java.rmi.RemoteException;
import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBObject;
 
public class TestObject extends AbstractDBObject
{
 
  /**
	 * 
	 */
	private static final long serialVersionUID = 1L;

/**
   * ct
   * @throws RemoteException
   */
  public TestObject() throws RemoteException
  {
    super();
  }
 
  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getPrimaryAttribute()
   */
  public String getPrimaryAttribute() throws RemoteException
  {
    return "name";
  }
 
  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
   */
  protected String getTableName()
  {
    return "files";
  }
 
  /**
   * Liefert den Namen der Datei.
   * @return Name der Datei.
   * @throws RemoteException
   */
  public String getName() throws RemoteException
  {
    return (String) this.getAttribute("name");
  }
 
  /**
   * Speichert den Namen der Datei.
   * @param name Name der Datei.
   * @throws RemoteException
   */
  public void setName(String name) throws RemoteException
  {
    setAttribute("name",name);
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
}

