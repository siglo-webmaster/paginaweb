--CATEGORIAS

--TIPOS DE CATEGORIAS
insert into tipos_categorias (nombre, descripcion) values ('Categoria raiz', 'Categorias principales que apareceran en el menu principal de navegacion');
insert into tipos_categorias (nombre, descripcion) values ('Categoria secundaria', 'Categorias secundarias. No aparecen el menu principal');

	--CATEGORIAS

ALTER TABLE categorias DROP COLUMN nombre_key ;



insert into categorias values('1','1','0','Derecho','activo');
insert into categorias values('2','1','0','Filosofía','activo');
insert into categorias values('4','1','0','Educación','activo');
insert into categorias values('5','1','0','Política','activo');
insert into categorias values('6','1','0','Ecología','activo');
insert into categorias values('7','1','0','Género','activo');
insert into categorias values('3','1','0','Política','activo');
insert into categorias values('9','1','0','Literatura','activo');
insert into categorias values('10','1','0','Arte','activo');
insert into categorias values('11','1','0','Religiones y Teología','activo');
insert into categorias values('12','1','0','Ciencias Básicas','activo');
insert into categorias values('8','1','0','Medicina','activo');
insert into categorias values('13','1','0','Ciencias Humanas y Sociales','activo');
insert into categorias values('14','1','0','Revistas','activo');
insert into categorias values('15','1','0','Ingeniería','activo');
insert into categorias values('16','1','0','Derechos Humanos','activo');
insert into categorias values('17','2','1','Derecho Público','activo');
insert into categorias values('18','2','1','Derecho Administrativo','activo');
insert into categorias values('19','2','1','Derecho Ambiental','activo');
insert into categorias values('20','2','1','Derecho Canónico','activo');
insert into categorias values('21','2','1','Derecho Civil','activo');
insert into categorias values('22','2','1','Derecho Comercial','activo');
insert into categorias values('23','2','1','Derecho Constitucional','activo');
insert into categorias values('24','2','1','Derecho Económico','activo');
insert into categorias values('25','2','1','Derecho Internacional','activo');
insert into categorias values('26','2','1','Derecho Laboral','activo');
insert into categorias values('27','2','1','Derecho Notarial','activo');
insert into categorias values('28','2','1','Derecho Penal','activo');
insert into categorias values('29','2','1','Derecho Privado','activo');
insert into categorias values('30','2','1','Derecho Procesal','activo');
insert into categorias values('31','2','1','Derecho Romano','activo');
insert into categorias values('32','2','1','Derecho Tributario','activo');
insert into categorias values('33','2','1','Filosofía del Derecho','activo');
insert into categorias values('34','2','1','Sociología del Derecho','activo');
insert into categorias values('35','2','1','Derechos Humanos','activo');
insert into categorias values('36','2','2','Filosofía Crítica','activo');
insert into categorias values('37','2','2','Epistemología','activo');
insert into categorias values('38','2','2','Estética','activo');
insert into categorias values('39','2','2','Filosofía Política','activo');
insert into categorias values('40','2','2','Hermenéutica','activo');
insert into categorias values('41','2','2','Lógica','activo');
insert into categorias values('42','2','2','Metafísica','activo');
insert into categorias values('43','2','4','Pedagogía','activo');
insert into categorias values('44','2','4','Didáctica','activo');
insert into categorias values('45','2','4','Teoría Pedagógica','activo');
insert into categorias values('46','2','5','Ciencia Política','activo');
insert into categorias values('47','2','5','Economía Política','activo');
insert into categorias values('48','2','5','Violencia','activo');
insert into categorias values('49','2','5','Relaciones Internacionales','activo');
insert into categorias values('50','2','14','Antropología - Sociología','activo');
insert into categorias values('51','2','14','Arte – Estética','activo');
insert into categorias values('52','2','14','Arquitectura - Urbanismo - Diseño','activo');
insert into categorias values('53','2','3','Bioética','activo');
insert into categorias values('54','2','9','Cuento','activo');
insert into categorias values('55','2','9','Ensayo','activo');
insert into categorias values('56','2','9','Novela','activo');
insert into categorias values('57','2','9','Periodismo','activo');
insert into categorias values('58','2','9','Poesía','activo');
insert into categorias values('59','2','9','Teatro','activo');
insert into categorias values('60','2','9','Crítica Literaria','activo');
insert into categorias values('61','2','9','Teoría Literaria','activo');
insert into categorias values('62','2','10','Arquitectura','activo');
insert into categorias values('63','2','10','Artes Plásticas','activo');
insert into categorias values('64','2','10','Diseño','activo');
insert into categorias values('65','2','10','Fotografía','activo');
insert into categorias values('66','2','10','Catálogos','activo');
insert into categorias values('67','2','14','Cine - Fotografía - Audiovisuales','activo');
insert into categorias values('68','2','12','Física','activo');
insert into categorias values('69','2','12','Matemáticas','activo');
insert into categorias values('70','2','12','Biología','activo');
insert into categorias values('71','2','8','Salud','activo');
insert into categorias values('72','2','8','Odontología','activo');
insert into categorias values('73','2','5','Derechos Humanos','activo');
insert into categorias values('74','2','6','Naturaleza','activo');
insert into categorias values('75','2','6','Ecosistemas','activo');
insert into categorias values('76','2','6','Ecología Humana','activo');
insert into categorias values('77','2','6','Ecología Urbana','activo');
insert into categorias values('78','2','10','Estética','activo');
insert into categorias values('79','2','14','Derecho','activo');
insert into categorias values('80','2','14','Ecología','activo');
insert into categorias values('81','2','14','Economía - Administración','activo');
insert into categorias values('82','2','14','Educación','activo');
insert into categorias values('83','2','14','Filosofía - Ética','activo');
insert into categorias values('84','2','14','Filosofía de la ciencia','activo');
insert into categorias values('85','2','14','Género','activo');
insert into categorias values('86','2','14','Historia - Geografía','activo');
insert into categorias values('87','2','10','Danza','activo');
insert into categorias values('88','2','9','Literatura Infantil','activo');
insert into categorias values('89','2','10','Música','activo');
insert into categorias values('90','2','10','Cine','activo');
insert into categorias values('91','2','11','Judaísmo','activo');
insert into categorias values('92','2','10','Teatro','activo');
insert into categorias values('93','2','5','Historia','activo');
insert into categorias values('94','2','3','Ética Empresarial','activo');
insert into categorias values('95','2','11','Mitologías','activo');
insert into categorias values('96','2','11','Teología','activo');
insert into categorias values('97','2','11','Teología Cristiana','activo');
insert into categorias values('98','2','11','Mística','activo');
insert into categorias values('99','2','2','Historia de la Filosofía','activo');
insert into categorias values('100','2','2','Filosofía de la Religión','activo');
insert into categorias values('101','2','11','Historia de las Religiones','activo');
insert into categorias values('102','2','10','Historia del Arte','activo');
insert into categorias values('103','2','2','Teodicea','activo');
insert into categorias values('104','2','4','Psicología Cognitiva','activo');
insert into categorias values('105','2','4','Biblioteca Escolar','activo');
insert into categorias values('106','2','12','Química','activo');
insert into categorias values('107','2','4','Psicología','activo');
insert into categorias values('108','2','4','Psicología Evolutiva','activo');
insert into categorias values('109','2','4','Salud','activo');
insert into categorias values('110','2','4','Educación de Adultos','activo');
insert into categorias values('111','2','5','Globalización','activo');
insert into categorias values('112','2','5','Filosofía Política','activo');
insert into categorias values('113','2','6','Ecología Política','activo');
insert into categorias values('114','2','5','Sociología Política','activo');
insert into categorias values('115','2','7','Sociología','activo');
insert into categorias values('116','2','5','Política Exterior','activo');
insert into categorias values('117','2','13','Comunicación','activo');
insert into categorias values('118','2','13','Historia','activo');
insert into categorias values('119','2','13','Género','activo');
insert into categorias values('120','2','13','Administración','activo');
insert into categorias values('121','2','12','Geometría','activo');
insert into categorias values('122','2','1','Derecho de Familia','activo');
insert into categorias values('123','2','13','Economía','activo');
insert into categorias values('124','2','13','Antropología','activo');
insert into categorias values('125','2','13','Sociología','activo');
insert into categorias values('126','2','2','Semiótica','activo');
insert into categorias values('127','2','8','Veterinaria','activo');
insert into categorias values('128','2','9','Narrativa','activo');
insert into categorias values('129','2','2','Humanismo','activo');
insert into categorias values('130','2','13','Psicología','activo');
insert into categorias values('131','2','13','Psicoanálisis','activo');
insert into categorias values('132','2','4','Psicología Educativa','activo');
insert into categorias values('133','2','4','Política Educativa','activo');
insert into categorias values('134','2','4','Historia de la Educación','activo');
insert into categorias values('135','2','4','Poesía','activo');
insert into categorias values('136','2','13','Linguística','activo');
insert into categorias values('137','2','4','Filosofía de la Educación','activo');
insert into categorias values('138','2','11','Filosofia de la Religión','activo');
insert into categorias values('139','2','5','Política de Paz','activo');
insert into categorias values('140','2','13','Estética','activo');
insert into categorias values('141','2','13','Geografía','activo');
insert into categorias values('142','2','1','Derecho Financiero','activo');
insert into categorias values('143','2','1','Derecho Mercantil','activo');
insert into categorias values('144','2','13','Política','activo');
insert into categorias values('145','2','4','Educación Artística','activo');
insert into categorias values('146','2','4','Educación Musical','activo');
insert into categorias values('147','2','4','Sociología de la Educación','activo');
insert into categorias values('148','2','4','Didáctica del Lenguaje','activo');
insert into categorias values('149','2','4','Educación Ambiental','activo');
insert into categorias values('150','2','4','Metodología del Estudio','activo');
insert into categorias values('151','2','4','Educación y Medios','activo');
insert into categorias values('152','2','2','Filosofía del Derecho','activo');
insert into categorias values('153','2','12','Geología','activo');
insert into categorias values('154','2','6','Investigacion','activo');
insert into categorias values('155','2','13','Metodología','activo');
insert into categorias values('156','2','8','Neurología','activo');
insert into categorias values('157','2','5','Política y Cultura','activo');
insert into categorias values('158','2','4','Educación Universitaria','activo');
insert into categorias values('159','2','1','Teoría Jurídica','activo');
insert into categorias values('160','2','2','Ética','activo');
insert into categorias values('161','2','8','Oncología','activo');
insert into categorias values('162','2','4','Educación en Salud','activo');
insert into categorias values('163','2','4','Educación en Informática','activo');
insert into categorias values('164','2','4','Educación Cooperativa','activo');
insert into categorias values('165','2','7','Género Testimonio','activo');
insert into categorias values('166','2','7','Género Comunicación','activo');
insert into categorias values('167','2','7','Género Literatura','activo');
insert into categorias values('168','2','7','Género Economía','activo');
insert into categorias values('169','2','7','Género Política','activo');
insert into categorias values('170','2','7','Género Educación','activo');
insert into categorias values('171','2','7','Género Psicología','activo');
insert into categorias values('172','2','2','Fenomenología','activo');
insert into categorias values('173','2','7','Género Historia','activo');
insert into categorias values('174','2','7','Género Filosofía','activo');
insert into categorias values('175','2','2','Antropología Filosófica','activo');
insert into categorias values('176','2','14','Literatura – Linguística','activo');
insert into categorias values('177','2','14','Música - Teatro - Danza','activo');
insert into categorias values('178','2','14','Pensamiento y Cultura','activo');
insert into categorias values('179','2','14','Política','activo');
insert into categorias values('180','2','14','Psicología - Psicoanálisis - Psiquiatría','activo');
insert into categorias values('181','2','1','Legislación Informática','activo');
insert into categorias values('182','2','1','Derecho Disciplinario','activo');
insert into categorias values('183','2','12','Informática','activo');
insert into categorias values('184','2','1','Derecho Arbitral','activo');
insert into categorias values('185','2','15','Ingeniería Civil','activo');
insert into categorias values('186','2','4','Educación Infantil','activo');
insert into categorias values('187','2','8','Oftalmología y Optometría','activo');
insert into categorias values('188','2','8','Anatomía','activo');
insert into categorias values('189','2','4','Evaluación','activo');
insert into categorias values('190','2','4','Educación Rural','activo');
insert into categorias values('191','2','8','Farmacología','activo');
insert into categorias values('192','2','2','Filosofía Analítica','activo');
insert into categorias values('193','2','16','Historia','activo');
insert into categorias values('194','2','16','Sociología','activo');
insert into categorias values('195','2','16','Política','activo');
insert into categorias values('196','2','14','Derechos Humanos','activo');
insert into categorias values('197','2','4','Educación en Valores','activo');
insert into categorias values('198','2','14','Medicina','activo');
insert into categorias values('199','2','2','Filosofía y Literatura','activo');
insert into categorias values('200','2','15','Ingeniería Electrónica','activo');
insert into categorias values('201','2','8','Cirugía','activo');
insert into categorias values('202','2','4','Capacitación','activo');
insert into categorias values('203','2','4','Educación en Ciencia','activo');
insert into categorias values('204','2','4','Textos Escolares','activo');
insert into categorias values('205','2','1','Derecho de Internet','activo');
insert into categorias values('206','2','8','Neumología','activo');
insert into categorias values('207','2','8','Epidemiología','activo');
insert into categorias values('208','2','8','Obstetricia','activo');
insert into categorias values('209','2','8','Pediatría','activo');
insert into categorias values('210','2','7','Derecho','activo');
insert into categorias values('211','2','4','Educación Física','activo');
insert into categorias values('212','2','14','Ciencias Básicas','activo');
insert into categorias values('213','2','15','Bioingeniería','activo');
insert into categorias values('214','2','15','Ingeniería Ambiental','activo');
insert into categorias values('215','2','1','Derecho De Las Telecomunicaciones','activo');
insert into categorias values('216','2','8','Fisioterapia','activo');
insert into categorias values('217','2','1','Derecho Registral','activo');
insert into categorias values('218','2','15','Ingeniería Mecánica','activo');
insert into categorias values('219','2','14','Ingeniería','activo');
insert into categorias values('220','2','15','Ingeniería De Sistemas','activo');
insert into categorias values('221','2','15','Ingeniería Industrial','activo');
insert into categorias values('222','2','15','Ingeniería Hidráulica','activo');
insert into categorias values('223','2','1','Derecho Alternativo','activo');
insert into categorias values('224','2','1','Derecho Urbanístico','activo');
insert into categorias values('225','2','15','Ingeniería Agrícola','activo');
insert into categorias values('226','2','8','Cardiología','activo');
insert into categorias values('227','2','8','Psiquiatría','activo');
insert into categorias values('228','2','2','Filosofía Del Lenguaje','activo');
insert into categorias values('229','1','0','Sin Clasificar','activo');


ALTER TABLE `categorias` ADD COLUMN `nombre_key` VARCHAR(255) NULL  AFTER `nombre` ;


--FIN CATEGORIAS


--PAISES

INSERT INTO paises (nombre) VALUES  ('COLOMBIA'),
 ('VENEZUELA'),
 ('ECUADOR'),
 ('PERU'),
 ('BOLIVIA'),
 ('PANAMA'),
 ('MEXICO');

--FIN PAISES

--DEPARTAMENTOS
INSERT INTO departamentos (paises_id_paises,nombre) values ('1','BOGOTA D.C'),('1','CUNDINAMARCA'); 
--FIN DEPARTAMENTOS

--CIUDADES 

INSERT INTO ciudades (departamentos_id_departamentos, nombre) VALUES  (1,'BOGOTA'),(2,'ANAPOIMA');


--FIN CIUDADES

--TIPOS DE TERCEROS
insert into tipos_terceros (nombre, parametros, estado) values ('cliente','','activo'), ('proveedor','','activo') ;
----FIN TIPOS DE TERCEROS

-- TIPOS DE DOCUMENTO


INSERT INTO tipo_documento (nombre) VALUES  ('CC'),
 ('NIT');


-- FIN TIPOS DOCUMENTOS


--PROVEEDORES

insert into terceros (tipo_documento_id_tipo_documento, identificacion,ciudades_id_ciudades,estado) values('2','1','1','activo');
insert into terceros_tipos_terceros (terceros_id_terceros, tipos_terceros_id_tipos_terceros) values('1','2');
insert into terceros_atributos (terceros_id_terceros, llave, valor) values ('1','nombre','siglo del hombre');

insert into terceros (tipo_documento_id_tipo_documento, identificacion,ciudades_id_ciudades,estado) values('2','1','1','activo');
insert into terceros_tipos_terceros (terceros_id_terceros, tipos_terceros_id_tipos_terceros) values('2','2');
insert into terceros_atributos (terceros_id_terceros, llave, valor) values ('2','nombre','Tirant Lo Blanch');

insert into terceros (tipo_documento_id_tipo_documento, identificacion,ciudades_id_ciudades,estado) values('2','1','1','activo');
insert into terceros_tipos_terceros (terceros_id_terceros, tipos_terceros_id_tipos_terceros) values('3','2');
insert into terceros_atributos (terceros_id_terceros, llave, valor) values ('3','nombre','Publidisa');




--FIN PROVEEDORES


--- CARGA CATEGORIAS PROVEEDORES

-- CARGA TIRANT
INSERT INTO categorias_proveedores (codigo,nombre,id_terceros_proveedores) VALUES  ('0100000000','Jurídico',2),
 ('0101000000','Derecho Civil y Mercantil',2),
 ('0101010000','Obras generales, manuales universitarios tratados de derecho civil',2),
 ('0101020000','Obras Generales, Manuales y Tratados de Derecho Mercantil',2),
 ('0101030000','Formularios',2),
 ('0101040000','Legislación',2),
 ('0101060000','Derecho de la persona',2),
 ('0101070000','Personas jurídicas (asociaciones y fundaciones)',2),
 ('0101080000','Derecho de Obligaciones y contratos',2),
 ('0101080100','Teoría general',2),
 ('0101080200','Compraventa y permuta',2),
 ('0101080300','Arrendamientos y propiedad horizontal',2),
 ('0101080400','Derecho de daños y responsabilidad civil',2),
 ('0101080500','Contratos de servicios ( Prestación de servicios, ejecución de obra, transpo',2),
 ('0101080600','Sociedad civil',2),
 ('0101080700','Propiedad intelectual',2),
 ('0101090000','Derechos reales',2),
 ('0101090100','En general',2),
 ('0101090200','Usufructo',2),
 ('0101090300','Servidumbre',2),
 ('0101090400','Hipoteca',2),
 ('0101090500','Otros',2),
 ('0101100000','Derecho Registral y Notarial ( Registro Civil y Mercantil, Derecho Hipotecar',2),
 ('0101110000','Derecho de Familia',2),
 ('0101110100','Menores',2),
 ('0101110200','Matrimonial',2),
 ('0101110300','Otros',2),
 ('0101120000','Derecho de Sucesiones',2),
 ('0101130000','Derecho Forales',2),
 ('0101140000','Contratación Mercantil en general',2),
 ('0101150000','Derecho de seguros',2),
 ('0101160000','Contratación bancaria',2),
 ('0101170000','Derecho de sociedades',2),
 ('0101170100','Sociedades de Capital ( Anónima y Limitada )',2),
 ('0101170200','Otras formas sociales',2),
 ('0101180000','Competencia y propiedad industrial',2),
 ('0101190000','Derecho Marítimo',2),
 ('0101200000','Derecho del mercado de valores',2),
 ('0101210000','Títulos valores',2),
 ('0101220000','Derecho de la insolvencia ( personal y empresarial )',2),
 ('0101230000','Derecho de las Telecomunicaciones',2),
 ('0101240000','Derecho de consumo',2),
 ('0101250000','Derecho informático',2),
 ('0101260000','Derecho de patentes',2),
 ('0101270000','Transporte',2),
 ('0101280000','Derecho Concursal',2),
 ('0102000000','Derecho Administrativo',2),
 ('0102010000','Manuales y obras generales',2),
 ('0102010100','Parte general',2),
 ('0102010200','Parte especial',2),
 ('0102020000','Formularios',2),
 ('0102030000','Legislación',2),
 ('0102050000','Derecho autonómico',2),
 ('0102060000','Derecho local',2),
 ('0102070000','Derecho urbanístico y de la construcción',2),
 ('0102070100','Derecho urbanístico',2),
 ('0102070200','Derecho de la construcción',2),
 ('0102080000','Contratación pública',2),
 ('0102090000','Régimen público de los bienes',2),
 ('0102090100','Aguas',2),
 ('0102090200','Costas',2),
 ('0102090300','Puertos',2),
 ('0102090400','Carreteras',2),
 ('0102090500','Minas',2),
 ('0102090600','Patrimonio histórico y otros',2),
 ('0102100000','Función pública',2),
 ('0102110000','Procedimiento administrativo',2),
 ('0102120000','Jurisdicción Contenciosa',2),
 ('0102130000','Expropiación forzosa',2),
 ('0102150000','Derecho ambiental',2),
 ('0102150100','Ecología',2),
 ('0102160000','Deporte',2),
 ('0102170000','Responsabilidad patrimonial de la administración',2),
 ('0102180000','Derecho de la sanidad',2),
 ('0102190000','Derecho del turismo',2),
 ('0102200000','Extranjería',2),
 ('0102210000','Telecomunicaciones',2),
 ('0102220000','Protección de Datos',2),
 ('0103000000','Derecho Penal',2),
 ('0103010000','Obras generales y manuales universitarios',2),
 ('0103020000','Formularios',2),
 ('0103030000','Legislación',2),
 ('0103050000','Parte general del derecho penal',2),
 ('0103050100','Introducción (Norma, Ley, Interpretación, Fuentes, Derecho Penal Internacion',2),
 ('0103050200','Teoría del delito',2),
 ('0103050300','Teoría de la pena',2),
 ('0103050400','Circunstancias modificativas de la responsabilidad criminal',2),
 ('0103060000','Derecho Penal.Parte especial',2),
 ('0103060100','Vida, integridad física y salud',2),
 ('0103060200','Libertad sexual, honor, intimidad y propia imagen',2),
 ('0103060300','Delitos contra la salud pública',2),
 ('0103060400','Delitos contra la administración pública',2),
 ('0103060500','Otros',2),
 ('0103070000','Derecho Penal económico y afines',2),
 ('0103070100','Delitos contra la propiedad (mueble e inmueble)',2),
 ('0103070200','Delitos contra la propiedad intelectual',2),
 ('0103070300','Hacienda pública y seguridad social',2),
 ('0103070400','Delitos contra la propiedad intelectual e industrial',2),
 ('0103070500','Insolvencias punibles',2),
 ('0103070600','Delitos societarios',2),
 ('0103070700','Delitos contra la hacienda pública y la seguridad social',2),
 ('0103070800','Contra los derechos de los trabajadores',2),
 ('0103070900','Delito urbanístico',2),
 ('0103071000','Falsedades documentales',2),
 ('0103071100','Otros',2),
 ('0103080000','Derecho Penitenciario',2),
 ('0104000000','Derecho del Trabajo',2),
 ('0104010000','Obras generales y manuales universitarios',2),
 ('0104020000','Formularios',2),
 ('0104030000','Legislación',2),
 ('0104040000','Obras actualizables y CD-Rom',2),
 ('0104050000','Contratación laboral',2),
 ('0104060000','Extinción del contrato de trabajo',2),
 ('0104070000','Negociación colectiva',2),
 ('0104080000','La relación laboral',2),
 ('0104080100','Salario',2),
 ('0104080200','Jornada',2),
 ('0104080300','Otros aspectos de la relación laboral',2),
 ('0104090000','Derecho sindical',2),
 ('0104100000','Seguridad social',2),
 ('0104110000','Proceso laboral y de la seguridad social',2),
 ('0104120000','Seguridad y salud laboral',2),
 ('0105000000','Derecho Procesal',2),
 ('0105010000','Manuales y obras generales',2),
 ('0105020000','Formularios',2),
 ('0105030000','Legislación',2),
 ('0105040000','Obras actualizables y CD-Rom',2),
 ('0105050000','Derecho procesal civil',2),
 ('0105060000','Derecho procesal penal',2),
 ('0106000000','Derecho Financiero y Tributario',2),
 ('0106010000','Manuales y obras generales',2),
 ('0106020000','Formularios',2),
 ('0106030000','Legislación',2),
 ('0106050000','Derecho presupuestario',2),
 ('0106060000','Haciendas autonómicas y locales',2),
 ('0106070000','Tributos en general',2),
 ('0106080000','Liquidación, inspección y recaudación de tributos',2),
 ('0106090000','Revisión de actos tributarios',2),
 ('0106100000','Infracciones y sanciones tributarias',2),
 ('0106110000','Impuesto de la renta sobre las personas físicas',2),
 ('0106120000','Impuesto de sociedades',2),
 ('0106130000','Impuesto Sobre el Valor Añadido (IVA)',2),
 ('0106140000','Impuesto sobre transmisiones patrimoniales y actos jurídicos documentados',2),
 ('0106150000','Impuesto de sucesiones y donaciones',2),
 ('0106160000','Otros impuestos: aduanas, fiscalidad internacional y otros',2),
 ('0106170000','Tributos locales',2),
 ('0106170100','IAE',2),
 ('0106170200','IBI',2),
 ('0106170300','Incremento del valor de los terrenos de naturaleza urbana',2),
 ('0106170400','Impuestos de la construcción',2),
 ('0106170500','Contribuciones especiales',2),
 ('0106170600','Otros',2),
 ('0107000000','Derecho Constitucional',2),
 ('0107010000','Manuales y obras generales',2),
 ('0107020000','Derechos fundamentales',2),
 ('0107030000','Distrubución de competencias entre el Estado y las CC.AA.',2),
 ('0107040000','Sistema de fuentes',2),
 ('0107050000','Otras materias',2),
 ('0107060000','Legislación',2),
 ('0107070000','Derecho comparado',2),
 ('0107080000','Tribunal Constitucional',2),
 ('0108000000','Derecho Eclesiástico del Estado y Derecho Canónico',2),
 ('0109000000','Derecho Internacional',2),
 ('0109010000','Público',2),
 ('0109020000','Privado',2),
 ('0109030000','Comunitario',2),
 ('0109040000','Legislación',2),
 ('0110000000','Derecho Romano e Historia del Derecho',2),
 ('0110010000','Derecho Romano',2),
 ('0110020000','Historia del derecho',2),
 ('0111000000','Introducción al Derecho. Teoría Jurídica',2),
 ('0111010000','Introducción al derecho',2),
 ('0111020000','Sociología del derecho',2),
 ('0111030000','Filosofía del derecho y teoría general del derecho',2),
 ('0111040000','Derechos humanos',2),
 ('0112000000','Criminología y Criminalística',2),
 ('0112010000','Criminología',2),
 ('0112020000','Ciencias policiales y criminalística',2),
 ('0113000000','Oposiciones',2),
 ('0113010000','Judicatura y secretarios judiciales',2),
 ('0113020000','Oficiales auxiliares y agentes',2),
 ('0113030000','Cuerpos de la administración local',2),
 ('0113040000','Cuerpos de la administración autonómica',2),
 ('0113050000','Varios',2),
 ('0114000000','Revista Jurídica',2),
 ('0115000000','Cine y Derecho',2),
 ('0116000000','Diccionario Jurídico',2),
 ('0117000000','Producto electrónico',2),
 ('0117010000','Libro electrónico',2),
 ('0118000000','Argumentación Jurídica',2),
 ('0200000000','Ciencias Sociales',2),
 ('0201000000','Economía',2),
 ('0201010000','En general',2),
 ('0201020000','Microeconomía',2),
 ('0201030000','Macroeconomía',2),
 ('0201030100','En general',2),
 ('0201030200','Economía financiera y monetaria',2),
 ('0201030300','Política fiscal',2),
 ('0201030400','Sector exterior y comercio internacional',2),
 ('0201030500','Empleo',2),
 ('0201030600','Inflación',2),
 ('0201040000','Historia de la economía',2),
 ('0201040100','Mundial',2),
 ('0201040200','Americana',2),
 ('0201040300','Europea',2),
 ('0201040400','Española',2),
 ('0201050000','Economía Política',2),
 ('0201060000','Estadística',2),
 ('0201070000','Nueva economía',2),
 ('0201080000','Informática',2),
 ('0201090000','Turismo',2),
 ('0202000000','Empresa',2),
 ('0202010000','Producción',2),
 ('0202020000','Recursos humanos',2),
 ('0202030000','Marketing',2),
 ('0202030100','Comportamiento del consumidor',2),
 ('0202030200','Marketing estrátegico',2),
 ('0202030300','Dirección de marketing',2),
 ('0202040000','Administración de empresas',2),
 ('0202040100','En general',2),
 ('0202040200','Técnica comercial',2),
 ('0202040300','Formación profesional',2),
 ('0202050000','Calidad',2),
 ('0202060000','Prevención de Riesgos Laborales',2),
 ('0203000000','Contabilidad',2),
 ('0203010000','En general',2),
 ('0203020000','Analítica',2),
 ('0203030000','Financiera',2),
 ('0203040000','Matemáticas',2),
 ('0204000000','Ciencias políticas',2),
 ('0205000000','Sociología',2),
 ('0205010000','Teorías sociológicas',2),
 ('0205020000','Demografía',2),
 ('0205030000','Sociología del trabajo',2),
 ('0205040000','Sociología del deporte',2),
 ('0205050000','Sociología de los medios de masas',2),
 ('0205060000','Sociología de las organizaciones',2),
 ('0205070000','Historia de la sociología',2),
 ('0205080000','Feminismo',2),
 ('0206000000','Bienestar social',2),
 ('0207000000','Informática aplicada',2),
 ('0208000000','Deportes',2),
 ('0209000000','Divulgación científica',2),
 ('0210000000','Ensayo',2),
 ('0211000000','Oposiciones',2),
 ('0212000000','Protocolo',2),
 ('0213000000','Ocio',2),
 ('0214000000','Criminología',2),
 ('0215000000','Libro electrónico',2),
 ('0300000000','Humanidades',2),
 ('0301000000','Antropología',2),
 ('0302000000','Geografía',2),
 ('0302010000','Geografía de España',2),
 ('0302010100','Descriptiva',2),
 ('0302010200','Humana social, política y cultural',2),
 ('0302010300','Atlas y mapas',2),
 ('0302020000','Geografía Mundial',2),
 ('0302020100','Descriptiva',2),
 ('0302020200','Humana social, política y cultural',2),
 ('0302020300','Atlas y Mapas',2),
 ('0303000000','Bellas Artes',2),
 ('0303010000','Obras generales y teoría del arte',2),
 ('0303020000','Antigua',2),
 ('0303030000','Medieval',2),
 ('0303040000','Moderna ( Renacimiento y Barroco )',2),
 ('0303050000','Contemporánea ( Desde el Neoclasicismo a nuestros días )',2),
 ('0303060000','Revistas de arte',2),
 ('0304000000','Historia',2),
 ('0304010000','Obras generales',2),
 ('0304020000','Prehistoria y Arqueología',2),
 ('0304030000','Antigua',2),
 ('0304040000','Medieval',2),
 ('0304050000','Moderna',2),
 ('0304060000','Contemporánea',2),
 ('0304070000','Paleografía y Numismática',2),
 ('0305000000','Biblioteconomía y Archivística',2),
 ('0305010000','Biblioteconomía',2),
 ('0305020000','Archivística',2),
 ('0306000000','Filosofía',2),
 ('0306010000','Filosofía Contemporánea',2),
 ('0306020000','Lógica, teoría del conocimiento y filosofía de la ciencia',2),
 ('0306030000','Estética',2),
 ('0306040000','Ética',2),
 ('0306040100','Política',2),
 ('0306050000','Metafísica',2),
 ('0306060000','Filosofía Clásica',2),
 ('0306070000','Filosofía Oriental',2),
 ('0307000000','Teología y religiones',2),
 ('0308000000','Psicología',2),
 ('0308010000','Historia de la Psicología',2),
 ('0308020000','Psicología básica',2),
 ('0308030000','Psicobiología',2),
 ('0308040000','Psicología de la personalidad',2),
 ('0308050000','Psicología evolutiva',2),
 ('0308060000','Psicología social y de organizaciones',2),
 ('0308070000','Psicología Clínica',2),
 ('0308080000','Metodología',2),
 ('0308090000','Autoayuda',2),
 ('0308100000','Psicoanálisis',2),
 ('0309000000','Pedagogía',2),
 ('0309010000','Historia de la educación',2),
 ('0309020000','Teoría de la educación',2),
 ('0309030000','Didáctica y organización escolar',2),
 ('0309040000','Investigación y diagnóstico',2),
 ('0310000000','Ciencias de la información',2),
 ('0310010000','Periodismo',2),
 ('0310020000','Audiovisual',2),
 ('0310030000','Comunicación',2),
 ('0311000000','Filología, Linguística y Teoría de los Lenguajes',2),
 ('0311010000','Filología Hispánica',2),
 ('0311020000','Filología Catalana',2),
 ('0311030000','Filología Inglesa',2),
 ('0311050000','Filología Clásica',2),
 ('0311060000','Otras Filologías',2),
 ('0311070000','Gramáticas',2),
 ('0311080000','Fonología',2),
 ('0311090000','Semántica',2),
 ('0311100000','Teoría de los lenguajes',2),
 ('0311110000','Otros',2),
 ('0311110100','Sintaxis',2),
 ('0312000000','Clásicos griegos y latinos',2),
 ('0313000000','Diccionarios y enciclopedias',2),
 ('0313010000','Castellano o Español',2),
 ('0313020000','Catalán y Valenciano',2),
 ('0313030000','Inglés',2),
 ('0313040000','Francés',2),
 ('0313050000','Alemán',2),
 ('0313060000','Latín y griego',2),
 ('0313070000','Italiano, Portugués-Gallego',2),
 ('0313080000','Otros',2),
 ('0313090000','Enciclopedias',2),
 ('0314000000','Biografías',2),
 ('0314010000','Clásicos',2),
 ('0314020000','Contemporáneos',2),
 ('0315000000','Música',2),
 ('0316000000','Fotografía',2),
 ('0317000000','Ciencias Ocultas',2),
 ('0318000000','Ajedrez',2),
 ('0319000000','Libro electrónico',2),
 ('0400000000','Literatura e Historia de la Literatura',2),
 ('0401000000','Poesía',2),
 ('0401010000','Castellana',2),
 ('0401010100','Medieval',2),
 ('0401010200','Moderna',2),
 ('0401010300','Contemporánea',2),
 ('0401010400','Hispanoamericana',2),
 ('0401020000','Catalana',2),
 ('0401020100','( Hasta el Siglo XVIII incluído )',2),
 ('0401020200','Contemporánea',2),
 ('0401030000','Inglesa y Americana',2),
 ('0401040000','Francesa',2),
 ('0401050000','Alemana',2),
 ('0401060000','Otras',2),
 ('0401070000','Lengua',2),
 ('0401080000','Teatro',2),
 ('0402000000','Teatro',2),
 ('0402010000','Teatro Clásico ( hasta el Siglo XIX Incluido )',2),
 ('0402020000','Teatro Contemporáneo',2),
 ('0402030000','Técnica Teatral',2),
 ('0403000000','Narrativa',2),
 ('0403010000','Narrativa castellana',2),
 ('0403010100','Narrativa medieval',2),
 ('0403010200','Narrativa moderna',2),
 ('0403010300','Narrativa Contemporánea',2),
 ('0403010400','Narrativa hispanoamericana',2),
 ('0403010500','Narrativa Erótica',2),
 ('0403010501','Narrativa Gay y Lésbica',2),
 ('0403010600','Relatos',2),
 ('0403010700','Narrativa Gay y Lésbica',2),
 ('0403020000','Narrativa catalana, valenciana y balear',2),
 ('0403020100','(Hasta el siglo XVIII incluido)',2),
 ('0403020200','Narrativa (Siglos XIX al XXI)',2),
 ('0403030000','Narrativa inglesa y americana',2),
 ('0403040000','Narrativa Alemana y Escandinava',2),
 ('0403050000','Narrativa de otros países',2),
 ('0403060000','BestSellers',2),
 ('0403070000','Ciencia Ficción',2),
 ('0403070100','Terror',2),
 ('0403070200','Fantasía',2),
 ('0403070300','Ciencia Ficción',2),
 ('0403080000','Novela histórica',2),
 ('0403090000','Novela policíaca',2),
 ('0403100000','Narrativa Infantil y Juvenil',2),
 ('0403100100','Narrativa infantil catalana, valenciana y balear',2),
 ('0403100200','Cómics',2),
 ('0403100300','Poesía Infantil',2),
 ('0403100400','Calendarios',2),
 ('0403100500','Agenda',2),
 ('0403100600','Primeros lectores',2),
 ('0403100700','Libros de juegos',2),
 ('0403100800','Desplegables',2),
 ('0403100900','Narrativa Infantil y Juvenil',2),
 ('0403101000','Cuentos',2),
 ('0403110000','Narrativa Francesa',2),
 ('0403120000','Humor',2),
 ('0403130000','Narrativa Vasca',2),
 ('0403140000','Novela Romántica',2),
 ('0404000000','Ensayo y Crítica Literaria',2),
 ('0404010000','Crítica literaria',2),
 ('0404010100','Crítica Literaria Española',2),
 ('0404010101','Teatro',2),
 ('0404010102','Poesía',2),
 ('0404010103','Narrativa',2),
 ('0404010200','Crítica Literaria Catalana',2),
 ('0404010201','Teatro',2),
 ('0404010202','Poesía',2),
 ('0404010203','Narrativa',2),
 ('0404010300','Crítica Literaria Extranjera',2),
 ('0404010301','Teatro',2),
 ('0404010302','Poesía',2),
 ('0404010303','Narrativa',2),
 ('0404020000','Ensayo',2),
 ('0405000000','Historia de la Literatura',2),
 ('0405010000','Antigua ( latina y griega )',2),
 ('0405020000','Edad media',2),
 ('0405030000','Siglo de Oro',2),
 ('0405040000','Moderna y Contemporánea',2),
 ('0405050000','Hispanoamericana',2),
 ('0406000000','Libros de Viajes y Guías',2),
 ('0406010000','Libros de Viajes',2),
 ('0406020000','Guías',2),
 ('0406020100','Guías de España',2),
 ('0406020200','Guías de Europa',2),
 ('0406020300','Resto del mundo',2),
 ('0406020400','Gastronomía',2),
 ('0500000000','Informática',2),
 ('0501000000','Ofimática',2),
 ('0501010000','Word',2),
 ('0501020000','Access',2),
 ('0501030000','Excel',2),
 ('0501040000','Otros',2),
 ('0502000000','Windows',2),
 ('0503000000','Diseño Gráfico',2),
 ('0504000000','Redes',2),
 ('0505000000','Internet',2),
 ('0506000000','Hardware',2),
 ('0507000000','Lenguajes de Programación',2),
 ('0507010000','Linux',2),
 ('0507020000','Unix',2),
 ('0507030000','Visual Basic',2),
 ('0507040000','MS-2',2),
 ('0507050000','Java',2),
 ('0507060000','Oracle',2),
 ('0507070000','SQL',2),
 ('0507080000','Otros',2),
 ('0508000000','Varios',2),
 ('0600000000','Ciencias',2),
 ('0601000000','Arquitectura',2),
 ('0601010000','Construcción',2),
 ('0601020000','Varios',2),
 ('0601030000','Ensayo',2),
 ('0601040000','Monográficos',2),
 ('0601050000','Revistas',2),
 ('0603000000','Diseño',2),
 ('0609000000','Ingeniería',2),
 ('0609010000','Ingeniería Civil',2),
 ('0609010100','Carreteras',2),
 ('0609010200','Ferrocarriles',2),
 ('0609010300','Estructuras',2),
 ('0609010400','Hormigón',2),
 ('0609010500','Industrial',2),
 ('0609010600','Varios',2),
 ('0609020000','Instalaciones',2),
 ('0609030000','Materiales',2),
 ('0609040000','Calidad',2),
 ('0609060000','Dibujo Técnico',2),
 ('0609070000','Topografía',2),
 ('0609080000','Soldadura',2),
 ('0610000000','Física',2),
 ('0610010000','Electricidad y Magnetismo',2),
 ('0610020000','Fundamentos de Física',2),
 ('0610030000','Termodinámica',2),
 ('0610040000','Otros',2),
 ('0611000000','Química',2),
 ('0611010000','Analítica',2),
 ('0611020000','Fisicoquímica',2),
 ('0611030000','Fundamentos de Química',2),
 ('0611040000','Inorgánica',2),
 ('0611050000','Orgánica',2),
 ('0612000000','Biología',2),
 ('0613000000','Matemáticas',2),
 ('0614000000','Medio Ambiente',2),
 ('0615000000','Geología',2),
 ('0616000000','Mecánica',2),
 ('0617000000','Astronomía',2),
 ('0618000000','Tecnología',2),
 ('0700000000','Medicina',2),
 ('0701000000','Anatomía',2),
 ('0702000000','Anestesiología',2),
 ('0703000000','Cardiología',2),
 ('0704000000','Cirugía',2),
 ('0705000000','Neurología',2),
 ('0706000000','Dermatología y Venereología',2),
 ('0707000000','Inmunología y Alergia',2),
 ('0708000000','Endocrinología y Nutrición',2),
 ('0709000000','Farmacología',2),
 ('0710000000','Fisiología, Bioquímica y Biología',2),
 ('0712000000','Geriatría',2),
 ('0713000000','Ginecología',2),
 ('0714000000','Hematología y Hemoterapia',2),
 ('0716000000','Oftalmología',2),
 ('0717000000','Pediatría',2),
 ('0718000000','Traumatología',2),
 ('0719000000','Oncología',2),
 ('0720000000','Psiquiatría',2),
 ('0721000000','Enfermería',2),
 ('0722000000','Fisioterapia',2),
 ('0723000000','En general',2),
 ('0724000000','Veterinaria',2),
 ('0726000000','Odontologia',2),
 ('0727000000','Genética',2),
 ('0728000000','Urología',2),
 ('0729000000','Otorrinolaringología',2),
 ('0730000000','Nefrología',2),
 ('0731000000','Radiología',2),
 ('0732000000','Reumatología',2),
 ('0733000000','Neumología',2),
 ('0734000000','Medicina Deportiva',2),
 ('0735000000','Medicina Legal',2),
 ('0736000000','Medicina natural',2),
 ('0737000000','Medician Interna',2),
 ('0738000000','Medicina epidemiológica',2),
 ('0900000000','Colecciones',2);



---- FIN CARGA CATEGORIAS PROVEEDORES



-- BODEGAS

--TIPOS_BODEGAS

insert into tipos_bodegas(nombre,estado) values('bodega','activo');


insert into bodegas (id_tipos_bodegas,nombre,estado) values (1,'Bodega Principal','activo'),(1,'Libreria La Candelaria','activo'),(1,'Bodega cll 20','activo');

-- FIN BODEGAS


-- TIPOS DE PRODUCTOS

insert into tipos_productos(nombre,imagen) values ('Impreso','images/tiposproductos/impreso.jpeg');
insert into tipos_productos(nombre,imagen) values ('Ebook','images/tiposproductos/ebook.jpg');
insert into tipos_productos(nombre,imagen) values ('POD','images/tiposproductos/pod.jpg');
insert into tipos_productos(nombre,imagen) values ('Revista','images/tiposproductos/pod.jpg');
insert into tipos_productos(nombre,imagen) values ('Suscripcion','images/tiposproductos/pod.jpg');
-- FIN TIPOS DE PRODUCTOS

-- EDITORIALES

insert into editoriales(nombre,nombre_key,imagen) values('Siglo del Hombre','siglodelhombre','images/editoriales/she.gif');
insert into editoriales(nombre,nombre_key,imagen) values ('Tirant Lo Blanch','tirantloblanch','images/editoriales/logotirant.png');

-- FIN EDITORIALES


--- MONEDAS

INSERT INTO monedas (nombre,nombre_corto,tasa_actual,decimales,estado) VALUES  ('PESO COLOMBIANO','COP',1,0,'activo'),
('EURO','EUR', 2332.28 , 2,'activo'),
 ('DOLAR AMERICANO','USD', 1763.85 ,2,'activo');


-- FIN  MONEDAS

--- LISTAS DE PRECIOS


----FIN LISTAS DE PRECIOS

INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (1,'Impreso SHE 2012 Pesos','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (2,'Impreso SHE 2012 Euros','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (3,'Impreso SHE 2012 Dolares','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (1,'E-Books 2012 Pesos','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (2,'E-Books 2012 Euros','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (3,'E-Books 2012 Dolares','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (1,'POD 2012 Pesos','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (2,'POD 2012 Euros','2012-01-01','2012-12-31','activo');
INSERT INTO lista_precios (id_moneda,nombre, fecha_inicio, fecha_fin, estado) VALUES (3,'POD 2012 Dolares','2012-01-01','2012-12-31','activo');


--- PLATAFORMAS DE PAGO

INSERT INTO plataforma_pago (nombre, estado, url, imagen )VALUES  ('PagosOnline','activo','https://gateway2.pagosonline.net/apps/gateway/index.html','images/PagosOnline.jpg');
INSERT INTO plataforma_pago (nombre, estado, url, imagen )VALUES  ('Pagos Seguros en Linea','activo','https://gateway2.pagosonline.net/apps/gateway/index.html','images/pse.png');


INSERT INTO parametros_plataforma_pago VALUES  (1,1,'usuarioId','11767'),
 (2,1,'refVenta',''),
 (3,1,'url_confirmacion','http://www.recycler.com.co/pagosonline/paginaConfirmacion.php'),
 (4,1,'url_respuesta','http://www.recycler.com.co/pagosonline/paginaRespuesta.php'),
 (5,1,'descripcion',''),
 (6,1,'telefonoMovil',''),
 (7,1,'documentoIdentificacion',''),
 (8,1,'nombreComprador',''),
 (9,1,'emailComprador',''),
 (10,1,'valor',''),
 (11,1,'iva',''),
 (12,1,'baseDevolucionIva',''),
 (13,1,'prueba','1'),
 (14,1,'firma','');


INSERT INTO parametros_plataforma_pago VALUES  (15,2,'usuarioId','11767'),
 (16,2,'refVenta',''),
 (17,2,'url_confirmacion','http://www.recycler.com.co/pagosonline/paginaConfirmacion.php'),
 (18,2,'url_respuesta','http://www.recycler.com.co/pagosonline/paginaRespuesta.php'),
 (19,2,'descripcion',''),
 (20,2,'telefonoMovil',''),
 (21,2,'documentoIdentificacion',''),
 (22,2,'nombreComprador',''),
 (23,2,'emailComprador',''),
 (24,2,'valor',''),
 (25,2,'iva',''),
 (26,2,'baseDevolucionIva',''),
 (27,2,'prueba','1'),
 (28,2,'firma','');

--FIN PLATAFORMAS DE PAGO



-- TRANSPORTADORAS


INSERT INTO transportadoras (nombre, telefono, web, imagen, estado) VALUES  ('ENVIO WEB','','','','activo'),
('SERVIENTREGA','7700200','www.servientrega.com','images/transportadoras/servientrega.jpg','activo'),
 ('COORDINADORA','01 8000 520 555','www.coordinadora.com','images/transportadoras/coordinadora.jpg','activo');




INSERT INTO transportadoras_ciudades VALUES  (2,1,1,'5000'),
 (3,1,1,'4700'),
 (2,2,1,'7000'),
 (3,2,1,'6000');

--FIN TRANSPORTADORAS


/*DESTACADOS*/
insert into tipos_destacados (nombre,estado) values('Libros destacados en Homepage','activo'),
('Libros destacados en Menu Principal','activo'),
('Libros recomendados por libreria','activo'),
('Libros destacados en Categoria','activo'),
('Libros destacados en Editorial','activo'),
('Libros destacados en Autor','activo'),
('Libros destacados en Evento','activo'),
('Autores destacados en Homepage','activo'),
('Autor del mes', 'activo'),
('Editorial del mes','activo'),
('Libros mas vendidos','activo');


/*EVENTOS*/
insert into tipo_eventos(nombre, prioridad, estado) values ('En pagina principal','1','activo'),
('En pagina principal libreria','1','activo'),
('En menu principal pagina web','1','activo'),
('En la cuenta de usuario cliente','1','activo'),
('En la cuenta de usuario editor','1','activo'),
('En la cuenta de usuario librero','1','activo'),
('En la cuenta de usuario proveedor','1','activo'),
('En la cuenta de usuario administrador','1','activo'),
('Sala de prensa','1','activo'),
('Promociones y Descuentos','1','activo');

/*MICROSITIOS*/

insert into bloques_contenido(nombre,estado) values ('cabezote','activo'),
('menu_principal','activo'),
('cuerpo','activo'),
('pie_pagina','activo'),
('keywords','activo'),
('includes','activo');

insert into tipos_menus (nombre, estado) values ('menu_principal','activo');

insert into tipos_menus_items (nombre,css,estado) values ('nivel_1','','activo'),
('nivel_2','','activo'),
('publicidad_nivel_2','','activo');

/*BLOQUES MICROSITIOS*/
/*PARAMETROS PARA ADMINISTRACION*/

INSERT INTO usuarios (`email`, `passwd`, `nombre`, `estado`) VALUES ('oborja@siglodelhombre.com', '123456', 'Oscar M. Borja Niño', 'activo');
insert into grupos_usuarios(nombre,estado) values('root','activo'),('administradores','activo');
insert into usuarios_grupos_usuarios values(1,1);

insert into modulos (nombre,estado)values ('Destacados','activo'),('Eventos','Activo'),('Micrositios','Activo'),('Clientes','Activo'),('Usuarios','Activo'),('Grupousuarios','Activo'), ('Modulos','Activo'), ('Productos','Activo');

insert into modulos_grupos_usuarios values (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1);



/*CLIENTES FINALES*/
insert into clientes (id_tipo_documento,nit,nombre,username, passwd, id_ciudades,direccion, telefono,email,contacto,telefono_contacto, estado) values (1,1,'adso','adso','123456',1,'Direccion','telefono','adsoemail','contacto','telefono_contacto','activo');

