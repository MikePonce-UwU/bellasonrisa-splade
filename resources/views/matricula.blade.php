@seoTitle(__('Matrícula en línea'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matrícula en línea') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-splade-form stay restore-on-success confirm :action="route('matricula.store')" method="post">
            <x-form-section dusk="matricula_estudiante">
                <x-slot name="title">
                    {{ __('Información del niño') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('Información básica del infante (Nombre completo, fecha de nacimiento, código único del niño)') }}
                </x-slot>
                <x-slot name="form">
                    <x-splade-input id="nombres" name="nombres" label="Nombres:" autocomplete="nombres"
                        placeholder="Nombres del infante" class="col-span-6 sm:col-span-2" />
                    <x-splade-input id="apellidos" name="apellidos" label="Apellidos:" autocomplete="apellidos"
                        placeholder="Apellidos del infante" class="col-span-6 sm:col-span-2" />
                    <x-splade-input id="codigo_estudiante" name="codigo_estudiante" label="Código del estudiante:"
                        autocomplete="codigo_estudiante" placeholder="Código único del estudiante dado por el MINED"
                        class="col-span-6 sm:col-span-2" />
                    <x-splade-input id="fecha_nacimiento" date name="fecha_nacimiento" placeholder="Fecha de nacimiento"
                        label="Fecha de nacimiento:" class="col-span-6 sm:col-span-3" />
                    <x-splade-group name="sexo_estudiante" class="col-span-6 sm:col-span-3" label="Sexo:" inline>
                        <x-splade-radio name="sexo_estudiante" value="m" label="Masculino" />
                        <x-splade-radio name="sexo_estudiante" value="f" label="Femenino" />
                    </x-splade-group>
                    <x-splade-textarea autosize placeholder="Lugar de nacimiento" id="lugar_nacimiento"
                        name="lugar_nacimiento" label="Lugar de nacimiento:" class="col-span-6 sm:col-span-6" />
                    <x-splade-input id="created_at" disabled date time :value="now()" name="created_at"
                        label="Fecha de inscripción:" class="col-span-6 sm:col-span-3" />
                    <x-splade-select placeholder="Seleccione el grado a cursar" id="grade_id" name="grade_id"
                        label="Grado a cursar:" :options="$grades" class="col-span-6 sm:col-span-3" />
                    <x-splade-textarea autosize id="direccion" name="direccion" class="col-span-6 sm:col-span-6"
                        placeholder="Dirección del hogar del niño" label="Dirección:" />
                    <x-splade-textarea autosize id="expediente_medico" name="expediente_medico"
                        placeholder="En caso de que el niño posea alergias o alguna condición externa, por favor especificar..."
                        class="col-span-6 sm:col-span-6" label="Afecciones médicas:" />
                </x-slot>
            </x-form-section>
            <x-section-border />
            <x-form-section dusk="matricula_padres_de_familia">
                <x-slot name="title">{{ __('Información del tutor') }}</x-slot>
                <x-slot name="description">
                    {{ __('Información del padre/madre de familia a cargo del estudiante') }}
                </x-slot>
                <x-slot name="form">
                    <x-splade-input id="nombre_completo" name="nombre_completo" label="Nombre completo:"
                        autocomplete="nombre_completo" placeholder="Nombre completo del padre"
                        class="col-span-6 sm:col-span-6" />
                    <x-splade-input id="cedula" name="cedula" label="Cédula:" autocomplete="cedula"
                        placeholder="Cedula del padre" class="col-span-6 sm:col-span-3" />
                    <x-splade-input id="telefono" name="telefono" label="Teléfono:" autocomplete="telefono"
                        placeholder="Teléfono del padre" class="col-span-6 sm:col-span-3" />
                    <x-splade-group name="sexo_padre" class="col-span-6 sm:col-span-3" label="Sexo:" inline>
                        <x-splade-radio name="sexo_padre" value="m" label="Masculino" />
                        <x-splade-radio name="sexo_padre" value="f" label="Femenino" />
                    </x-splade-group>
                    <x-splade-input id="email" name="email" type="email" label="E-mail:" autocomplete="email"
                        placeholder="Correo electrónico del padre" class="col-span-6 sm:col-span-3" />
                </x-slot>
                <x-slot name="actions">
                    <x-action-message v-if="form.recentlySuccessful" class="mr-3">
                        {{ __('Saved.') }}
                    </x-action-message>

                    <x-splade-submit :label="__('Save')" />
                </x-slot>
            </x-form-section>
        </x-splade-form>
    </div>
</x-app-layout>
