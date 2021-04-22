<template>
	<v-app>
		<v-main>
			<v-container class="fill-height" fluid>
				<v-row align="center" justify="center">
					<v-col cols="12" sm="8" md="8">
						<v-card class="elevation-8">
							<v-window>
								<v-row>
									<v-col cols="12" md="8">
										<v-card-text class="mt-2">
											<h1
												class="text-center mb-4 display-2 indigo--text text--accent-3"
											>
												CRUD V.I.F.L
											</h1>
											<h4 class="text-center mb-4">
												Inicie sesión en su espacio de
												trabajo
											</h4>
											<v-alert v-show="toggle" v-model="alert" transition="scale-transition" class="my-2 mb-4" dense dismissible outlined type="error">{{mensaje}}</v-alert>
											<v-form ref="form">
												<!-- <input type="hidden" name="_token" :value="csrf">            -->
												<v-text-field
													v-model="form.email"
													label="Correo electrónico"
													name="email"
													type="text"
													color="indigo accent-3"
													prepend-icon="mdi-email-outline"
												></v-text-field>

												<v-text-field
													v-model="form.password"
													label="Contraseña"
													name="password"
													color="indigo accent-3"
													prepend-icon="mdi-lock-outline"
													:type="
														show
															? 'text'
															: 'password'
													"
													:append-icon="
														show
															? 'mdi-eye'
															: 'mdi-eye-off'
													"
													@click:append="show = !show"
												>
												</v-text-field>

												<v-col cols="5">
													<v-checkbox
													v-model="form.remember"
													label="Recuérdame"
												></v-checkbox>
												</v-col>
												

												<div class="text-center">
													<v-btn
														class="white--text"
														rounded
														color="indigo accent-3"
														:disabled="
															form.processing ||
															!form.email ||
															!form.password
														"
														@click.prevent="login"
														>Ingresar</v-btn
													>
												</div>
											</v-form>
											<div class="text-center mt-3">
												<a
													class="indigo--text"
													href="https://www.google.com"
													><strong
														>¿Olvidó su
														contraseña?</strong
													></a
												>
											</div>
										</v-card-text>
									</v-col>
									<v-col
										cols="12"
										md="4"
										class="indigo accent-3"
									>
										<v-card-text class="mt-2 white--text">
											<h1 class="text-center display-1">
												¿Nuevo por aquí?
											</h1>
											<h4 class="text-center mt-4">
												En tan solo unos pasos puedes
												conectar con nosotros
											</h4>
										</v-card-text>
										<div class="text-center py-3">
											<v-btn rounded outlined dark
												>Crear cuenta</v-btn
											>
										</div>
									</v-col>
								</v-row>
							</v-window>
						</v-card>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
	</v-app>
</template>
 
<script>
export default {
	data() {
		return {
			form: this.$inertia.form({
				email: "",
				password: "",
				remember: true,
			}),
			show: false,
			mensaje: '',
			alert: false,
			toggle: false,
		};
	},
	methods: {
		login() {
			// this.form.post(this.route("login"), {
			// 	onFinish: () => this.form.reset("password", "email"),
			// });
			this.alert = false;  
			const data = { email: this.form.email, password: this.form.password, remember: this.form.remember} 

			
			 axios.post('/login', data)
			.then(response => {
					this.$inertia.get(route('dashboard'))
				})
				.catch(error => {
					if (error.response && error.response.status === 422) {    
						let errorMessage = error.response.data.errors.email[0];
                  		this.mensaje = errorMessage;
                  		this.alert = true;                          
					} else {
						console.log(error);
					}
				});
		},
	},
};
</script>