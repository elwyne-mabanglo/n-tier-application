using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;
using System.Data;
using System.Data.SqlClient;
using System.Xml;


namespace sowa
{
    /// <summary>
    /// Summary description for phonebook
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line. 
    // [System.Web.Script.Services.ScriptService]
    public class phonebook : System.Web.Services.WebService
    {

        [WebMethod]
        public string HelloWorld()
        {
            return "Hello World";
        }

        [WebMethod]
        public string encodeMd5(string target)
        {
            System.Security.Cryptography.MD5 md5 = System.Security.Cryptography.MD5.Create();
            byte[] tBytes = System.Text.Encoding.ASCII.GetBytes(target);
            byte[] hash = md5.ComputeHash(tBytes);
            System.Text.StringBuilder sb = new System.Text.StringBuilder();
            for (int i = 0; i < hash.Length; i++)
            {
                sb.Append(hash[i].ToString("X2"));
            }
            return sb.ToString();
        }

        [WebMethod]
        public double toCentigrade(double dFahrenheit)
        {
            return (dFahrenheit - 32.0) * 0.5555555555556;
        }

		[WebMethod]
		public XmlDocument lookuptest(string surname)
		{
			string conString = "Data Source=SQL-SERVER;Initial Catalog=me324;User ID=me324;Password=12El05ma90";

			SqlConnection sqlConn = new SqlConnection(conString);

			SqlCommand sqlCmd = sqlConn.CreateCommand();
			sqlCmd.CommandType = CommandType.Text;
			sqlCmd.CommandText ="SELECT username, email FROM users WHERE username LIKE '%"+surname+"%'";

			SqlDataAdapter dataAdptr = new SqlDataAdapter();
			dataAdptr.SelectCommand = sqlCmd;
			DataSet dsStaff = new DataSet("HolidayAccommodation");
			dataAdptr.Fill(dsStaff, "users");

			XmlDocument xmlDom = new XmlDocument();
			xmlDom.LoadXml(dsStaff.GetXml());
			return xmlDom;
		}

        [WebMethod]
        public XmlDocument level2(string subBedroom, string subMin, string subMax, string subLocation, string subPropertyId,string pageNumber, string pageSize)
        {

            
            string conString = "Data Source=SQL-SERVER;Initial Catalog=me324;User ID=me324;Password=12El05ma90";
            SqlConnection sqlConn = new SqlConnection(conString);

            SqlCommand sqlCmd = sqlConn.CreateCommand();
            SqlCommand sqlCmd1 = sqlConn.CreateCommand();

            sqlCmd.CommandType = CommandType.Text;
        
            sqlCmd.CommandText = "SELECT property.propertyId, property.price, property.typeProperty, property.address, property.bedroom, property.title, property.description, property.location, property.kitchen, property.bathroom, property.livingRoom, property.garage, property.carpet, property.latitude, property.longitude, users.username, users.email, property.db FROM property INNER JOIN users ON property.userId = users.id";

            if (subMin != "" || subMax != "")
            {
                if (subMin == "")
                {
                    subMin = "1";
                }
                if (subMax == "")
                {
                    subMax = "100000000";
                }
                string conBedrom = " WHERE price BETWEEN " + subMin + " AND " + subMax;
                sqlCmd.CommandText = string.Concat(sqlCmd.CommandText, conBedrom);
            }

            if (subBedroom != "")
            {
                string conBedrom = " AND bedroom=" + subBedroom;
                sqlCmd.CommandText = string.Concat(sqlCmd.CommandText, conBedrom);
            }

            if (subLocation != "")
            {
                string conBedrom = "AND location LIKE '%" + subLocation + "%'";
                sqlCmd.CommandText = string.Concat(sqlCmd.CommandText, conBedrom);
            }

            if (subPropertyId != "")
            {
                string conBedrom = " AND propertyId=" + subPropertyId;
                sqlCmd.CommandText = string.Concat(sqlCmd.CommandText, conBedrom);
            }

            if (pageNumber != ""  || pageSize != "")
            {


                if (pageNumber == "")
                {
                    pageNumber = "1";
                }
                if (pageSize == "")
                {
                    pageSize = "10";
                }

                int isize = int.Parse(pageSize);
                int inumber = int.Parse(pageNumber);

                int start = isize * (inumber - 1);

                string conBedrom = " ORDER BY propertyId OFFSET " + start + " ROWS FETCH NEXT " + pageSize + " ROWS ONLY";
                sqlCmd.CommandText = string.Concat(sqlCmd.CommandText, conBedrom);
            }

            



            SqlDataAdapter da = new SqlDataAdapter();
            da.SelectCommand = sqlCmd;
            DataTable dt = new DataTable();
            
            da.Fill(dt);

            XmlDocument xmlDom = new XmlDocument();
            xmlDom.AppendChild(xmlDom.CreateElement("", "HolidayAccomodation", ""));
            XmlElement xmlRoot = xmlDom.DocumentElement;

            XmlElement xmlProperty, xmlPrice, xmladdress, xmlbedroom, xmltitle, xmldescription, xmllocation, xmlUser, xmlusername, xmlemail, xmlimage, xmlimageType, xmlimageName, xmlimageData, xmladdtionalDetails, xmlkitchen, xmlbathroom, xmllivingRoom, xmlgarage, xmlcarpet, xmllatitude, xmllongitude;
            XmlText xmlTxt;
            XmlAttribute xmlpropertyId, xmldb, xmlimageId;
            string propertyId, price, address, bedroom, title, description, location, db, username , email, imageId, imageType, imageName, imageData, kitchen, bathroom, livingRoom, garage, carpet, latitude, longitude;
            foreach (DataRow r in dt.Rows)
            {
                propertyId = r["propertyId"].ToString();
                price = r["price"].ToString();
                address = r["address"].ToString();
                bedroom = r["bedroom"].ToString();
                title = r["title"].ToString();
                description = r["description"].ToString();
                location = r["location"].ToString();
                db = r["db"].ToString();
                username = r["username"].ToString();
                email = r["email"].ToString();
                kitchen = r["kitchen"].ToString();
                bathroom = r["bathroom"].ToString();
                livingRoom = r["livingRoom"].ToString();
                garage = r["garage"].ToString();
                carpet = r["carpet"].ToString();
                latitude = r["latitude"].ToString();
                longitude = r["longitude"].ToString();

                xmlProperty = xmlDom.CreateElement("property");

                xmlpropertyId = xmlDom.CreateAttribute("propertyId");
                xmlpropertyId.Value = propertyId;
                xmlProperty.Attributes.Append(xmlpropertyId);

                xmldb = xmlDom.CreateAttribute("db");
                xmldb.Value = db;
                xmlProperty.Attributes.Append(xmldb);

                xmlPrice = xmlDom.CreateElement("price");
                xmlTxt = xmlDom.CreateTextNode(price);
                xmlPrice.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmlPrice);

                xmllocation = xmlDom.CreateElement("location");
                xmlTxt = xmlDom.CreateTextNode(location);
                xmllocation.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmllocation);

                xmladdress = xmlDom.CreateElement("address");
                xmlTxt = xmlDom.CreateTextNode(address);
                xmladdress.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmladdress);

                xmlbedroom = xmlDom.CreateElement("bedroom");
                xmlTxt = xmlDom.CreateTextNode(bedroom);
                xmlbedroom.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmlbedroom);

                xmltitle = xmlDom.CreateElement("title");
                xmlTxt = xmlDom.CreateTextNode(title);
                xmltitle.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmltitle);

                xmldescription = xmlDom.CreateElement("description");
                xmlTxt = xmlDom.CreateTextNode(description);
                xmldescription.AppendChild(xmlTxt);
                xmlProperty.AppendChild(xmldescription);   

                xmlUser = xmlDom.CreateElement("user");

                xmlusername = xmlDom.CreateElement("username");
                xmlTxt = xmlDom.CreateTextNode(username);
                xmlusername.AppendChild(xmlTxt);
                xmlUser.AppendChild(xmlusername);

                xmlemail = xmlDom.CreateElement("email");
                xmlTxt = xmlDom.CreateTextNode(email);
                xmlemail.AppendChild(xmlTxt);
                xmlUser.AppendChild(xmlemail);

                xmlProperty.AppendChild(xmlUser);


                sqlCmd1.CommandType = CommandType.Text;
                sqlCmd1.CommandText = "SELECT imageId, imageType, imageName, imageData FROM images WHERE propertyId = " + propertyId;
                SqlDataAdapter da1 = new SqlDataAdapter();
                da1.SelectCommand = sqlCmd1;
                DataTable dt1 = new DataTable();
                da1.Fill(dt1);

                foreach (DataRow t in dt1.Rows)
                {

                    xmlimage = xmlDom.CreateElement("image");


                    imageId = t["imageId"].ToString();
                    imageType = t["imageType"].ToString();
                    imageName = t["imageName"].ToString();
                    imageData = t["imageData"].ToString();

                    xmlimageId = xmlDom.CreateAttribute("imageId");
                    xmlimageId.Value = propertyId;
                    xmlimage.Attributes.Append(xmlimageId);

                    xmlimageType = xmlDom.CreateElement("imageType");
                    xmlTxt = xmlDom.CreateTextNode(imageType);
                    xmlimageType.AppendChild(xmlTxt);
                    xmlimage.AppendChild(xmlimageType);

                    xmlimageName = xmlDom.CreateElement("imageName");
                    xmlTxt = xmlDom.CreateTextNode(imageName);
                    xmlimageName.AppendChild(xmlTxt);
                    xmlimage.AppendChild(xmlimageName);

                    xmlimageData = xmlDom.CreateElement("imageData");
                    xmlTxt = xmlDom.CreateTextNode(imageData);
                    xmlimageData.AppendChild(xmlTxt);
                    xmlimage.AppendChild(xmlimageData);

                    xmlProperty.AppendChild(xmlimage);
                }

                xmladdtionalDetails = xmlDom.CreateElement("addtionalDetails");

                xmlkitchen = xmlDom.CreateElement("kitchen");
                xmlTxt = xmlDom.CreateTextNode(kitchen);
                xmlkitchen.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmlkitchen);

                xmlbathroom = xmlDom.CreateElement("bathroom");
                xmlTxt = xmlDom.CreateTextNode(bathroom);
                xmlbathroom.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmlbathroom);

                xmllivingRoom = xmlDom.CreateElement("livingRoom");
                xmlTxt = xmlDom.CreateTextNode(livingRoom);
                xmllivingRoom.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmllivingRoom);

                xmlgarage = xmlDom.CreateElement("garage");
                xmlTxt = xmlDom.CreateTextNode(garage);
                xmlgarage.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmlgarage);

                xmlcarpet = xmlDom.CreateElement("carpet");
                xmlTxt = xmlDom.CreateTextNode(carpet);
                xmlcarpet.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmlcarpet);

                xmllatitude = xmlDom.CreateElement("latitude");
                xmlTxt = xmlDom.CreateTextNode(latitude);
                xmllatitude.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmllatitude);

                xmllongitude = xmlDom.CreateElement("longitude");
                xmlTxt = xmlDom.CreateTextNode(longitude);
                xmllongitude.AppendChild(xmlTxt);
                xmladdtionalDetails.AppendChild(xmllongitude);

                xmlProperty.AppendChild(xmladdtionalDetails);


                xmlRoot.AppendChild(xmlProperty);
            }
            return xmlDom;
        }
    }
}
