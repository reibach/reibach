package reibach.server;

import java.rmi.RemoteException;

import reibach.ReibachPlugin;
import reibach.rmi.ReibachDBService;
import de.willuhn.datasource.db.EmbeddedDBServiceImpl;
import de.willuhn.jameica.system.Application;

/**
 * this is our database service which can work over RMI.
 */
public class ReibachDBServiceImpl extends EmbeddedDBServiceImpl implements ReibachDBService
{
  /**
   * ct.
   * @throws RemoteException
   */
  public ReibachDBServiceImpl() throws RemoteException
  {
    super(Application.getPluginLoader().getPlugin(ReibachPlugin.class).getResources().getWorkPath() + "/db/db.conf",
    			"exampleuser", "examplepassword");

    // We have to define jameicas classfinder.
    // otherwise, the db service will not be able to find
    // implementors by their interfaces.  
    this.setClassFinder(Application.getClassLoader().getClassFinder());
  }
}