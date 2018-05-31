<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<%@ page import="java.io.*" %>
<%@ page import="javax.servlet.http.Part" %>
<%@ page import="javax.servlet.annotation.MultipartConfig" %>
<%@page import="java.sql.*,zetAmp_App.Registration"%>
<%@page import="java.util.*,java.util.Date,java.text.*,java.math.BigDecimal"%>
<body>
<%!
public static InputStream convert(Part filePart)
{
	InputStream inputStream = null; 
    if (filePart != null) {
     /*    System.out.println(filePart.getName());
        System.out.println(filePart.getSize());
        System.out.println(filePart.getContentType()); */
         
        try {
			inputStream = filePart.getInputStream();
		} catch (IOException e) {
			e.printStackTrace();
		}
    }
    return inputStream;
}
%>
<%
Calendar cal=Calendar.getInstance();
Date d=cal.getTime();
	DateFormat df= new SimpleDateFormat("dd-MM-yyyy HH:mm:ss");
	Date d1=cal.getTime();
  	 String dt= df.format(d1);
InputStream io= null;
InputStream io1= null;
InputStream io2= null;
InputStream io3= null;
String tos="",ccs="",bccs="";
String sender=request.getParameter("id");
String[] receiver=request.getParameterValues("to");

tos=receiver[0];
if(receiver.length>1){
for(int i=1;i<receiver.length;i++){
	tos=tos+','+receiver[i];
}
}
String[] cc=request.getParameterValues("cc");
if(cc!=null){
ccs=cc[0];
if(cc.length>1){
for(int i=1;i<cc.length;i++){
	ccs=ccs+','+cc[i];
}
}
}
else
{
	ccs="";
}
String[] bcc=request.getParameterValues("bcc");
if(bcc!=null){
bccs=bcc[0];
if(bcc.length>1){
for(int i=1;i<bcc.length;i++){
	bccs=bccs+','+bcc[i];
}
}
}
else
{
	bccs="";
}
String sub=request.getParameter("sub");
String msg=request.getParameter("msg");
Part f1=request.getPart("f1");
Part f2=request.getPart("f2");
Part f3=request.getPart("f3");
Part f4=request.getPart("f4");
io=convert(f1);
io1=convert(f2);
io2=convert(f3);
io3=convert(f4);
Connection con=null;
PreparedStatement pstmt=null;
Statement stmt=null;
ResultSet rs=null;
String total="";
String qry1="select count(*) from zetampdb.mailbox_tab";
String qry="insert into zetampdb.mailbox_tab values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
con=Registration.getConnect();
stmt=con.createStatement();
rs=stmt.executeQuery(qry1);
if(rs.next()){
	total=rs.getString(1);
}
String mailid="M"+(Integer.parseInt(total)+1);
pstmt=con.prepareStatement(qry);
pstmt.setString(1,mailid);
pstmt.setString(2,sender);
pstmt.setString(3, tos);
pstmt.setString(4,ccs);
pstmt.setString(5,bccs);
pstmt.setString(6,sub);
pstmt.setString(7,msg);
pstmt.setBlob(8,io);
pstmt.setBlob(9,io1);
pstmt.setBlob(10,io2);
pstmt.setBlob(11,io3);
pstmt.setString(12,dt);
pstmt.setString(13,"newmail");
pstmt.setString(14,"");
pstmt.setString(15,"");
pstmt.setString(16,"");
int j=pstmt.executeUpdate();
if(j>0){
	out.print("<script>");
	out.print("alert('Mail Sent');");
	out.print("window.location='mailboxmain.jsp?id="+sender+"';");
	out.print("</script>");
}
else
{
	out.print("<script>");
	out.print("alert('Mail Sending Failed');");
	out.print("window.location='mailboxmain.jsp?id="+sender+"';");
	out.print("</script>");
}



%>
</body>
</html>