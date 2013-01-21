<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classMainMenu
 *
 * @author adso
 */
class classMainMenu {
    var $print;
    function getMainMenu(){
        $this->print = '<div class="oe_wrapper">
			<ul id="oe_menu" class="oe_menu">
				<li><a href="">Ciencias, Ingenieria y Medicina</a>
					<div >
						<ul>
							<li class="oe_heading"><a href="index.php?action=searchList&opt=id_categoria&searchString=12">Ciencias Basicas</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=70">Biologia</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=68">Fisica</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=153">Geologia</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=121">Geometria</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=183">informatica</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=69">Matematicas</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=106">Quimica</a></li>
						</ul>
						
						<ul>
							<li class="oe_heading"><a href="index.php?action=searchList&opt=id_categoria&searchString=6">Ecologia</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=76">Ecologia Humana</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=113">Ecologia Politica</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=77">Ecologia Urbana</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=75">Ecosistemas</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=154">Investigacion</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=74">Naturaleza</a></li>
						</ul>

						<ul>
							<li class="oe_heading"><a href="index.php?action=searchList&opt=id_categoria&searchString=13">Ciencias Humanas y Sociales</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=120">Administracion</a></li>
							<li><a href="index.php?action=searchList&opt=id_categoria&searchString=124">Antropologia</a></li>
							<li><a href="index.php?action=searchList&opt=categoria&searchString=biblioteconomiaydocumentacion">Biblioteconomia y documentacion</a></li>
							<li><a href="index.php?action=searchList&opt=categoria&searchString=ceremonial protocolo">Ceremonial protocolo</a></li>
							<li><a href="#">Ciencias Ocultas</a></li>
							<li><a href="#">Comunicacion</a></li>
							<li><a href="#">Economia</a></li>

						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Estetica</a></li>
							<li><a href="#">Etica moral</a></li>
							<li><a href="#">FilosofIa</a></li>
							<li><a href="#">Genero</a></li>
							<li><a href="#">Geografia</a></li>
							<li><a href="#">Historia</a></li>
							<li><a href="#">Linguistica</a></li>

						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Metodologia</a></li>
							<li><a href="#">Otras publicaciones de ciencias humanas</a></li>
							<li><a href="#">Politica</a></li>
							<li><a href="#">Psicoanalisis</a></li>
							<li><a href="#">Psicologia</a></li>
							<li><a href="#">Sexualidad</a></li>
							<li><a href="#">Sociologia</a></li>

						</ul>
						<ul>
							<li class="oe_heading">Ingenieria</li>
							<li><a href="#">Bioingenieria</a></li>
							<li><a href="#">Ingenieria Agricola</a></li>
							<li><a href="#">Ingenieria Ambiental</a></li>
							<li><a href="#">Ingenieria Civil</a></li>
							<li><a href="#">Ingenieria De Sistemas</a></li>
							<li><a href="#">Ingenieria Electronica</a></li>
							<li><a href="#">Ingenieria Hidraulica</a></li>
							<li><a href="#">Ingenieria Industrial</a></li>
							<li><a href="#">Ingenieria Mecanica</a></li>

						</ul>
						
						<ul>
							<li class="oe_heading">Medicina</li>
							<li><a href="#">Anatomia</a></li>
							<li><a href="#">Cardiologia</a></li>
							<li><a href="#">Cirugia</a></li>
							<li><a href="#">Epidemiologia</a></li>
							<li><a href="#">Farmacologia</a></li>
							<li><a href="#">Fisioterapia</a></li>
							<li><a href="#">Neumologia</a></li>
							<li><a href="#">Neurologia</a></li>
							<li><a href="#">Obstetricia</a></li>
						</ul>
						
						<ul>
							<li class="oe_heading_white"></li>
							
							<li><a href="#">Odontologia</a></li>
							<li><a href="#">Oftalmologia Y Optometria</a></li>
							<li><a href="#">Oncologia</a></li>
							<li><a href="#">Pediatria</a></li>
							<li><a href="#">Psiquiatria</a></li>
							<li><a href="#">Salud</a></li>
							<li><a href="#">Veterinaria</a></li>

						</ul>
						
					</div>
				</li>
				<li><a href="">Derecho y Politica</a>
					<div style="left:-169px;"><!-- -112px -->
						<ul>
							<li class="oe_heading">Derecho</li>
							<li><a href="#">Codigos legales</a></li>
							<li><a href="#">Derecho Administrativo</a></li>
							<li><a href="#">Derecho Alternativo</a></li>
							<li><a href="#">Derecho Ambiental</a></li>
							<li><a href="#">Derecho Arbitral</a></li>
							<li><a href="#">Derecho Canonico</a></li>
							<li><a href="#">Derecho Civil</a></li>

						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Derecho Comercial</a></li>
							<li><a href="#">Derecho comunitario</a></li>
							<li><a href="#">Derecho Constitucional</a></li>
							<li><a href="#">Derecho De Familia</a></li>
							<li><a href="#">Derecho De Internet</a></li>
							<li><a href="#">Derecho De Las Telecomunicaciones</a></li>
							<li><a href="#">Derecho Disciplinario</a></li>

						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Derecho Economico</a></li>
							<li><a href="#">Derecho Financiero</a></li>
							<li><a href="#">Derecho financiero y tributario</a></li>
							<li><a href="#">Derecho Internacional</a></li>
							<li><a href="#">Derecho Laboral</a></li>
							<li><a href="#">Derecho Mercantil</a></li>
							<li><a href="#">Derecho Notarial</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Derecho Penal</a></li>
							<li><a href="#">Derecho Privado</a></li>
							<li><a href="#">Derecho Procesal</a></li>
							<li><a href="#">Derecho Publico</a></li>
							<li><a href="#">Derecho Registral</a></li>
							<li><a href="#">Derecho Romano</a></li>
							<li><a href="#">Derecho Tributario</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Derecho Urbanistico</a></li>
							<li><a href="#">Derechos Humanos</a></li>
							<li><a href="#">Filosofia Del Derecho</a></li>
							<li><a href="#">Legislacion Informatica</a></li>
							<li><a href="#">Otras publicaciones jurIdicas</a></li>
							<li><a href="#">Sin clasificar</a></li>
							<li><a href="#">Sociologia Del Derecho</a></li>
							<li><a href="#">Teoria Juridica</a></li>
						</ul>
						<ul>
							<li class="oe_heading">Derechos Humanos</li>
							<li><a href="#">Historia</a></li>
							<li><a href="#">Politica</a></li>
							<li><a href="#">Sociologia</a></li>

						</ul>

						<ul>
							<li class="oe_heading">Politica</li>
							<li><a href="#">Ciencia Politica</a></li>
							<li><a href="#">Derechos Humanos</a></li>
							<li><a href="#">Economia Politica</a></li>
							<li><a href="#">Filosofia Politica</a></li>
							<li><a href="#">Globalizacion</a></li>
							<li><a href="#">Historia</a></li>
							<li><a href="#">Politica De Paz</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Politica Exterior</a></li>
							<li><a href="#">Politica Y Cultura</a></li>
							<li><a href="#">Relaciones Internacionales</a></li>
							<li><a href="#">Sociologia Politica</a></li>
							<li><a href="#">Violencia</a></li>
						</ul>


					</div>
				</li>
				<li><a href="">Revistas y Suscripciones</a>
					<div style="left:-338px;">
						<ul >
							<li class="oe_heading">Revistas</li>
							<li><a href="#">Antropologia - Sociologia</a></li>
							<li><a href="#">Arquitectura - Urbanismo - Diseño</a></li>
							<li><a href="#">Arte - Estetica</a></li>
							<li><a href="#">Ciencias Basicas</a></li>
							<li><a href="#">Cine - Fotografia - Audiovisuales</a></li>
							<li><a href="#">Derecho</a></li>
							<li><a href="#">Derechos Humanos</a></li>

						</ul><ul >
							<li class="oe_heading_white"></li>
							<li><a href="#">Ecologia</a></li>
							<li><a href="#">Economia - Administracion</a></li>
							<li><a href="#">Educacion</a></li>
							<li><a href="#">Filosofia - etica</a></li>
							<li><a href="#">Filosofia De La Ciencia</a></li>
							<li><a href="#">Genero</a></li>
							<li><a href="#">Historia - Geografia</a></li>
						</ul><ul >
							<li class="oe_heading_white"></li>
							<li><a href="#">Ingenieria</a></li>
							<li><a href="#">Literatura - Linguistica</a></li>
							<li><a href="#">Medicina</a></li>
							<li><a href="#">Musica - Teatro - Danza</a></li>
							<li><a href="#">Pensamiento Y Cultura</a></li>
							<li><a href="#">Politica</a></li>
							<li><a href="#">Psicologia - Psicoanalisis - Psiquiatria</a></li>

						</ul>
						<ul>
							<li class="oe_heading">Suscripciones</li>
							<li><a href="#">Revista ACDI. Anuario colombiano de derecho internacional</a></li>
							<li><a href="#">Revista Análisis político  </a></li>
							<li><a href="#">Revista Anthropos  </a></li>
							<li><a href="#">Revista Anuario colombiano de historia  </a></li>
							<li><a href="#">Revista Avances en psicología  </a></li>
							<li><a href="#">Revista Ciencias de la salud  </a></li>
							<li><a href="#">Revista Colombiana de psicología  </a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Revista Colombiana de sociología  </a></li>
							<li><a href="#">Revista Cuadernos de geografía  </a></li>
							<li><a href="#">Revista de Economía  </a></li>
							<li><a href="#">Revista Desafíos  </a></li>
							<li><a href="#">Revista Desde el jardín de Freud  </a></li>
							<li><a href="#">Revista El Viejo Topo  </a></li>
							<li><a href="#">Revista Estudios Socio-jurídicos  </a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Revista Exit (Colombia)  </a></li>
							<li><a href="#">Revista Forma y función  </a></li>
							<li><a href="#">Revista Ideas y valores  </a></li>
							<li><a href="#">Revista Internacional de filosofía política  </a></li>
							<li><a href="#">Revista Literatura  </a></li>
							<li><a href="#">Revista Maguaré  </a></li>
							<li><a href="#">Revista Palimpsestus  </a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Revista Pasajes  </a></li>
							<li><a href="#">Revista Profile  </a></li>
							<li><a href="#">Revista Quimera  </a></li>
							<li><a href="#">Revista Territorios  </a></li>
							<li><a href="#">Revista Trabajo social  </a></li>
							<li><a href="#">Revista Universidad y empresa  </a></li>

						</ul>
					</div>
				</li>
				<li><a href="">Educacion, Etica y Teologia</a>
					<div style="left:-507px;">
						<ul>
							<li class="oe_heading">Educacion</li>
							<li><a href="#">Biblioteca Escolar</a></li>
							<li><a href="#">Capacitacion</a></li>
							<li><a href="#">Didactica</a></li>
							<li><a href="#">Didactica Del Lenguaje</a></li>
							<li><a href="#">Educacion Ambiental</a></li>
							<li><a href="#">Educacion Artistica</a></li>
							<li><a href="#">Educacion Cooperativa</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Educacion De Adultos</a></li>
							<li><a href="#">Educacion En Ciencia</a></li>
							<li><a href="#">Educacion En Informatica</a></li>
							<li><a href="#">Educacion En Salud</a></li>
							<li><a href="#">Educacion En Valores</a></li>
							<li><a href="#">Educacion Fisica</a></li>
							<li><a href="#">Educacion Infantil</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Educacion Musical</a></li>
							<li><a href="#">Educacion Rural</a></li>
							<li><a href="#">Educacion Universitaria</a></li>
							<li><a href="#">Educacion Y Medios</a></li>
							<li><a href="#">Evaluacion</a></li>
							<li><a href="#">Filosofia De La Educacion</a></li>
							<li><a href="#">Historia De La Educacion</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Metodologia Del Estudio</a></li>
							<li><a href="#">Pedagogia</a></li>
							<li><a href="#">Poesia</a></li>
							<li><a href="#">Politica Educativa</a></li>
							<li><a href="#">Psicologia</a></li>
							<li><a href="#">Psicologia Cognitiva</a></li>
							<li><a href="#">Psicologia Educativa</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Psicologia Evolutiva</a></li>
							<li><a href="#">Salud</a></li>
							<li><a href="#">Sociologia De La Educacion</a></li>
							<li><a href="#">Teoria Pedagogica</a></li>
							<li><a href="#">Textos Escolares</a></li>

						</ul>
						<ul>
							<li class="oe_heading">Etica</li>
							<li><a href="#">Bioetica</a></li>
							<li><a href="#">Etica Empresarial</a></li>

						</ul>
						<ul>
							<li class="oe_heading">Religiones y teologia</li>
							<li><a href="#">Filosofia De La Religion</a></li>
							<li><a href="#">Historia De Las Religiones</a></li>
							<li><a href="#">Judaismo</a></li>
							<li><a href="#">Mistica</a></li>
							<li><a href="#">Mitologias</a></li>
							<li><a href="#">Teologia</a></li>
							<li><a href="#">Teologia Cristiana</a></li>

						</ul>
					</div>
				</li>
				<li><a href="">Literatura y Genero</a>
					<div style="left:-676px;">
						<ul>
							<li class="oe_heading">Literatura</li>
							<li><a href="#">Ciencia ficcion</a></li>
							<li><a href="#">Comic de adultos</a></li>
							<li><a href="#">Critica Literaria</a></li>
							<li><a href="#">Cuento</a></li>
							<li><a href="#">Ensayo</a></li>
							<li><a href="#">Humor</a></li>
							<li><a href="#">Literatura clasica (Griega y Romana)</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Literatura de viajes y viajeros</a></li>
							<li><a href="#">Literatura fantastica</a></li>
							<li><a href="#">Literatura Infantil</a></li>
							<li><a href="#">Narrativa</a></li>
							<li><a href="#">Novela</a></li>
							<li><a href="#">Novela corta, cuentos y relatos</a></li>
							<li><a href="#">Novela erotica</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Novela historica</a></li>
							<li><a href="#">Novela policiaca</a></li>
							<li><a href="#">Obras completas</a></li>
							<li><a href="#">Otras publicaciones literarias</a></li>
							<li><a href="#">Periodismo</a></li>
							<li><a href="#">Poesia</a></li>
							<li><a href="#">Sin clasificar</a></li>
						</ul>
						<ul>
							<li class="oe_heading_white"></li>

							<li><a href="#">Teatro</a></li>
							<li><a href="#">Teoria Literaria</a></li>
							<li><a href="#">Terror</a></li>

						</ul>
						<ul>
							<li class="oe_heading">Genero</li>
							<li><a href="#">Derecho</a></li>
							<li><a href="#">Genero Comunicacion</a></li>
							<li><a href="#">Genero Economia</a></li>
							<li><a href="#">Genero Educacion</a></li>
							<li><a href="#">Genero Filosofia</a></li>
							<li><a href="#">Genero Historia</a></li>
							<li><a href="#">Genero Literatura</a></li>
                                                </ul>
						<ul>
                                                        <li class="oe_heading_white"></li>
							<li><a href="#">Genero Politica</a></li>
							<li><a href="#">Genero Psicologia</a></li>
							<li><a href="#">Genero Testimonio</a></li>
							<li><a href="#">Sociologia</a></li>

						</ul>
					</div>
				</li>
				<li><a href="">Arte y Filosofia</a>
					<div style="left:-845px;">

						<ul>
							<li class="oe_heading">Arte</li>
							<li><a href="#">Arquitectura</a></li>
							<li><a href="#">Artes plasticas</a></li>
							<li><a href="#">Catalogos</a></li>
							<li><a href="#">Cine</a></li>
							<li><a href="#">Danza</a></li>
							<li><a href="#">Diseño</a></li>
							<li><a href="#">Estetica</a></li>
							<li><a href="#">Fotografia</a></li>
							
						</ul>
						<ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Fotografia artistica</a></li>
							<li><a href="#">Historia del arte</a></li>
							<li><a href="#">Museos, catalogos y exposiciones</a></li>
							<li><a href="#">Musica</a></li>
							<li><a href="#">Otras publicaciones de bellas artes</a></li>
							<li><a href="#">Pintura</a></li>
							<li><a href="#">Teatro</a></li>
						</ul>

						<ul>
							<li class="oe_heading">Filosofia</li>
							<li><a href="#">Antropologia Filosofica</a></li>
							<li><a href="#">Epistemologia</a></li>
							<li><a href="#">Estetica</a></li>
							<li><a href="#">Etica</a></li>
							<li><a href="#">Fenomenologia</a></li>
							<li><a href="#">Filosofia Analitica</a></li>
							<li><a href="#">Filosofia Critica</a></li>
						</ul><ul>
							<li class="oe_heading_white"></li>							
							<li><a href="#">Filosofia De La Religion</a></li>
							<li><a href="#">Filosofia Del Derecho</a></li>
							<li><a href="#">Filosofia Del Lenguaje</a></li>
							<li><a href="#">Filosofia Politica</a></li>
							<li><a href="#">Filosofia Y Literatura</a></li>
							<li><a href="#">Hermeneutica</a></li>
							<li><a href="#">Historia De La Filosofia</a></li>
						</ul><ul>
							<li class="oe_heading_white"></li>
							<li><a href="#">Humanismo</a></li>
							<li><a href="#">Logica</a></li>
							<li><a href="#">Metafisica</a></li>
							<li><a href="#">Semiotica</a></li>
							<li><a href="#">Teodicea</a></li>

						</ul>
					</div>
				</li>

			</ul>	
		</div>
        <div>
        
	</div>';
        return $this->print;
    }
}

?>
