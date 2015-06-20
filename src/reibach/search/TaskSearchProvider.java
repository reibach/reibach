package reibach.search;

import java.rmi.RemoteException;
import java.util.ArrayList;
import java.util.List;

import reibach.Settings;
import reibach.gui.action.TaskDetail;
import reibach.rmi.Task;


import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.jameica.search.Result;
import de.willuhn.jameica.search.SearchProvider;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Extension to the jameica search service.
 * If you implement the "SearchProvider" interface, jameica automatically
 * detects the provider. You are now able to search for tasks in jameica.
 */
public class TaskSearchProvider implements SearchProvider
{
  /**
   * @see de.willuhn.jameica.search.SearchProvider#getName()
   */
  public String getName()
  {
    return Settings.i18n().tr("Tasks");
  }

  /**
   * @see de.willuhn.jameica.search.SearchProvider#search(java.lang.String)
   */
  public List search(String search) throws RemoteException, ApplicationException
  {
    // We have to return a list of "Result" objects
    List<Result> result = new ArrayList<Result>();
    if (search == null || search.length() < 3)
      return result;
    
    String s = "%" + search.toLowerCase() + "%";
    DBIterator tasks = Settings.getDBService().createList(Task.class);
    tasks.addFilter("lower(name) like ? or lower(comment) like ?",new Object[]{s,s});
    while (tasks.hasNext())
    {
      result.add(new MyResult((Task)tasks.next()));
    }
    return result;
  }
  
  /**
   * Our implementation of the search result items.
   */
  public class MyResult implements Result
  {
    private Task task = null;
    
    /**
     * ct.
     * @param task
     */
    private MyResult(Task task)
    {
      this.task = task;
    }
    
    /**
     * @see de.willuhn.jameica.search.Result#execute()
     */
    public void execute() throws RemoteException, ApplicationException
    {
      new TaskDetail().handleAction(this.task);
    }

    /**
     * @see de.willuhn.jameica.search.Result#getName()
     */
    public String getName()
    {
      try
      {
        return this.task.getProject().getName() + ": " + this.task.getName();
      }
      catch (Exception e)
      {
        Logger.error("unable to determine task name",e);
        return "";
      }
    }
    
  }

}
