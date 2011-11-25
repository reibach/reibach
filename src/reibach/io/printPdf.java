package reibach.io;

import java.io.FileOutputStream;
import java.io.IOException;
import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.util.Date;

import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;

 
/**
 * First iText example: Hello World.
 */
public class printPdf {
 
	public static void main(String[] args) {
        try {
            OutputStream file = new FileOutputStream(new File("/tmp/Test.pdf"));
 
            Document document = new Document();
            PdfWriter.getInstance(document, file);
            document.open();
            document.add(new Paragraph("Hallo Michi dsfdsfdsf dsf sd"));
            document.add(new Paragraph(new Date().toString()));
 
            document.close();
            file.close();
 
        } catch (Exception e) {
 
            e.printStackTrace();
        }
    }
}