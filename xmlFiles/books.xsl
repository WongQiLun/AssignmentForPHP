<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : food.xsl
    Created on : 4 August 2020, 2:17 pm
    Author     : user
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
        <html>
            <head>
                <title>Food</title>
            </head>
            <body>
                <h1>Food</h1>
                <hr />
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="foodList">
        <table border="1">
            <TR>
                <th>
                    no
                </th>
                <th>
                    name
                </th>
                <th>
                    carb
                </th>
                <th>
                    fiber
                </th>
                <th>
                    fat
                </th>
                <th>
                    kj
                </th>
            </TR>
            <xsl:for-each select="foodItem">
               <xsl:sort select="name" order="ascending"/>
            <tr>
                <td>
                    <xsl:value-of select="position()" />
                </td>
                <td>
                    <xsl:value-of select="name"/>
                </td>
                
                <td>
                    <xsl:value-of select="carbsPerServing"/>
                </td>
                
                 <td>
                    <xsl:value-of select="fiberPerServing"/>
                </td>
                 <td>
                    <xsl:value-of select="fatPerServing"/>
                </td>
                 <td>
                    <xsl:value-of select="kjPerServing"/>
                </td>
            </tr>
            </xsl:for-each>
        </table>
    </xsl:template>

</xsl:stylesheet>
