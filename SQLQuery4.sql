/****** Script for SelectTopNRows command from SSMS  ******/
SELECT DISCTIN LEFT(CONVERT(TIME, FECHA, 108),8)
      ,count(CODIGO) AS PROFESIONAL,
	  CODIGO
  FROM [RFAST8].[dbo].[fac_m_citas] where
   CONVERT(DATE, FECHA) = '2016-07-08' 
  GROUP BY FECHA, CODIGO ORDER BY CODIGO