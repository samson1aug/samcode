<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*"%>

<%@ page import="java.io.*"%>
<!DOCTYPE table PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>

<% 
String uid=(String)request.getAttribute("user");
System.out.print(uid);
String j=request.getParameter("id");

Blob image = null;

Connection con = null;

byte[ ] imgData = null ;

PreparedStatement stmt = null;

ResultSet rs = null;

Class.forName("com.mysql.jdbc.Driver");

con = DriverManager.getConnection("jdbc:mysql://localhost:3306?user=root&password=root");

stmt = con.prepareStatement("select attach from zetampdb.mailbox_tab where mailid=?");
stmt.setString(1,j);
rs = stmt.executeQuery();
if (rs.next()) {
	image = rs.getBlob(1);
	if(image==null)
	{
		out.print("<script>");
		out.print("alert('No File');");
		out.print("window.location='mailboxmain.jsp';");
		out.print("</script>");
		return;
	}
	imgData = image.getBytes(1,(int)image.length());
	response.setContentType("pdf/pdf");
	OutputStream o = response.getOutputStream();
	o.write(imgData);
	o.flush();
	o.close();
	
}%>