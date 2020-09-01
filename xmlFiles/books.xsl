<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>Book Catalog</title>
            </head>
            <body>
                <h1>Book Catalog </h1>
                <hr />
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="books">
        <table border="1">
            <TR>
                <th>
                    Book ID
                </th>
                <th>
                    Title
                </th>
                <th>
                    Author
                </th>
                <th>
                    Year
                </th>
                <th>
                    Status
                </th>
                <th>
                    Description
                </th>
                <th>
                    Location
                </th>
            </TR>
            <xsl:for-each select="book">
                <xsl:sort select="name" order="ascending"/>
                <tr>
                    <td>
                        <xsl:value-of select="@bookID" />
                    </td>
                    <td>
                        <xsl:value-of select="title"/>
                    </td>
                
                    <td>
                        <xsl:value-of select="author"/>
                    </td>
                
                    <td>
                        <xsl:value-of select="yearOfPub"/>
                    </td>
                    <td>
                        <xsl:value-of select="status"/>
                    </td>
                    <td>
                        <xsl:value-of select="description"/>
                    </td>
                    <td>
                        <xsl:value-of select="location"/>
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>

</xsl:stylesheet>
