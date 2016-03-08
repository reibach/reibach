/**********************************************************************
 * $Source: /cvsroot/jameica/jameica/src/de/willuhn/jameica/gui/formatter/CurrencyFormatter.java,v $
 * $Revision: 1.3 $
 * $Date: 2008/03/04 00:49:25 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/
package reibach.gui;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.Locale;

import de.willuhn.jameica.gui.formatter.Formatter;

/**
 * Formatierer fuer Geld-Betraege.
 * @author willuhn
 */
public class NumberFormatter implements Formatter
{


  private DecimalFormat formatter = (DecimalFormat) NumberFormat.getNumberInstance(Locale.getDefault());

  /**
   * Erzeugt einen neuen Formatierer mit dem angegeben Waehrungsstring.
   * @param currencyName Bezeichnung der Waehrung.
   * @param formatter kann optional angegeben werden, um den Betrag zu formatieren.
   * Wird der Parameter weggelassen, werden die Werte auf 2 Stellen hinter dem
   * Komma formatiert. 
   */
  public NumberFormatter(DecimalFormat formatter)
  {

    if (formatter == null)
      this.formatter.applyPattern("#0.00");
    else
      this.formatter = formatter;
  }

  /**
   * Formatiert das uebergeben Objekt.
   * Es kann von folgenden Typen sein:
   * <ul>
   *  <li>String</li>
   *  <li>Number (oder davon abgeleitete Typen)</li>
   * </ul>
   * @see de.willuhn.jameica.gui.formatter.Formatter#format(java.lang.Object)
   */
  public String format(Object o)
  {
    if (o == null)
      return "";
    if (o instanceof Number)
      return (formatter.format(((Number)o).doubleValue()));
    return o.toString();
  }

}
