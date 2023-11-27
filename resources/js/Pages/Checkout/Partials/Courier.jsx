import { IconCheck, IconChevronDown, IconLoader2 } from '@tabler/icons-react';
import { Fragment, useState } from 'react';
import { usePage } from '@inertiajs/react';
import { Listbox, Transition } from '@headlessui/react';
import clsx from 'clsx';

export default function Courier({
    services,
    setServices,
    selectedService,
    setSelectedService,
    selectedCourier,
    setSelectedCourier,
}) {
    const { shipping_address, total_weight, couriers } = usePage().props;

    const [loading, setLoading] = useState(false);

    async function chooseCourier(e) {
        setSelectedCourier(e);
        setLoading(true);
        try {
            const { data } = await axios.post(route('check-postage'), {
                courier: e.id,
                destination: shipping_address?.subdistrict_id
                    ? shipping_address?.subdistrict_id
                    : shipping_address?.city_id,
                destination_type: shipping_address?.subdistrict_id ? 'subdistrict' : 'city',
                weight: total_weight,
            });
            setServices(data);
            setLoading(false);
            setSelectedService(data[0]);
        } catch (e) {
            setLoading(false);
        }
    }

    function chooseService(e) {
        setSelectedService(e);
    }

    return (
        <div className='mt-10 border-t border-slate-200 pt-10'>
            <h2 className='text-lg font-medium text-slate-900'>Pilih Kurir</h2>
            <div className='mt-4 grid grid-cols-2 items-center gap-2'>
                <Listbox value={selectedCourier} onChange={chooseCourier}>
                    {({ open }) => (
                        <>
                            <Listbox.Label className='sr-only'>Pilih layanan</Listbox.Label>
                            <div className='relative'>
                                <div className='flex w-full divide-x divide-slate-200 overflow-hidden rounded-md border'>
                                    <div className='inline-flex w-full items-center gap-x-1.5 rounded-l-md bg-white px-3 py-2 text-slate-900 shadow-sm'>
                                        <p className='text-sm font-semibold'>
                                            {selectedCourier?.name || 'Pilih layanan'}
                                        </p>
                                    </div>
                                    <Listbox.Button className='inline-flex items-center bg-white px-2 py-2.5 hover:bg-slate-100 focus:outline-none'>
                                        <IconChevronDown className='h-5 w-5 text-slate-900' aria-hidden='true' />
                                    </Listbox.Button>
                                </div>

                                <Transition
                                    show={open}
                                    as={Fragment}
                                    leave='transition ease-in duration-100'
                                    leaveFrom='opacity-100'
                                    leaveTo='opacity-0'>
                                    <Listbox.Options className='absolute right-0 z-10 mt-2 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none'>
                                        {couriers.map((courier) => (
                                            <Listbox.Option
                                                key={courier.id}
                                                className={({ active }) =>
                                                    clsx(
                                                        active ? 'bg-blue-600 text-white' : 'text-gray-900',
                                                        'cursor-default select-none p-4 text-sm'
                                                    )
                                                }
                                                value={courier}>
                                                {({ selected, active }) => (
                                                    <div className='flex flex-col'>
                                                        <div className='flex justify-between'>
                                                            <p
                                                                className={clsx(
                                                                    selected ? 'font-semibold' : 'font-normal',
                                                                    'uppercase'
                                                                )}>
                                                                {courier.code}
                                                            </p>
                                                            {selected ? (
                                                                <span
                                                                    className={active ? 'text-white' : 'text-blue-600'}>
                                                                    <IconCheck className='h-5 w-5' aria-hidden='true' />
                                                                </span>
                                                            ) : null}
                                                        </div>
                                                        <div
                                                            className={clsx(
                                                                active ? 'text-blue-200' : 'text-gray-500',
                                                                'mt-2'
                                                            )}>
                                                            <div>{courier.name}</div>
                                                        </div>
                                                    </div>
                                                )}
                                            </Listbox.Option>
                                        ))}
                                    </Listbox.Options>
                                </Transition>
                            </div>
                        </>
                    )}
                </Listbox>

                <IconLoader2 className={`h-6 w-6 animate-spin text-slate-400 ${loading ? 'block' : 'hidden'}`} />
                {services.length && !loading > 0 ? (
                    <Listbox value={selectedService} onChange={chooseService}>
                        {({ open }) => (
                            <>
                                <Listbox.Label className='sr-only'>Pilih layanan</Listbox.Label>
                                <div className='relative'>
                                    <div className='flex w-full divide-x divide-slate-200 overflow-hidden rounded-md border'>
                                        <div className='inline-flex w-full items-center gap-x-1.5 rounded-l-md bg-white px-3 py-2 text-slate-900 shadow-sm'>
                                            <p className='text-sm font-semibold'>
                                                {selectedService?.name || 'Pilih layanan'}
                                            </p>
                                        </div>
                                        <Listbox.Button className='inline-flex items-center bg-white px-2 py-2.5 hover:bg-slate-100 focus:outline-none'>
                                            <IconChevronDown className='h-5 w-5 text-slate-900' aria-hidden='true' />
                                        </Listbox.Button>
                                    </div>

                                    <Transition
                                        show={open}
                                        as={Fragment}
                                        leave='transition ease-in duration-100'
                                        leaveFrom='opacity-100'
                                        leaveTo='opacity-0'>
                                        <Listbox.Options className='absolute right-0 z-10 mt-2 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none'>
                                            {services.map((service) => (
                                                <Listbox.Option
                                                    key={service.id}
                                                    className={({ active }) =>
                                                        clsx(
                                                            active ? 'bg-blue-600 text-white' : 'text-gray-900',
                                                            'cursor-default select-none p-4 text-sm'
                                                        )
                                                    }
                                                    value={service}>
                                                    {({ selected, active }) => (
                                                        <div className='flex flex-col'>
                                                            <div className='flex justify-between'>
                                                                <p
                                                                    className={
                                                                        selected ? 'font-semibold' : 'font-normal'
                                                                    }>
                                                                    Kurir {service.name}
                                                                </p>
                                                                {selected ? (
                                                                    <span
                                                                        className={
                                                                            active ? 'text-white' : 'text-blue-600'
                                                                        }>
                                                                        <IconCheck
                                                                            className='h-5 w-5'
                                                                            aria-hidden='true'
                                                                        />
                                                                    </span>
                                                                ) : null}
                                                            </div>
                                                            <div
                                                                className={clsx(
                                                                    active ? 'text-blue-200' : 'text-gray-500',
                                                                    'mt-2'
                                                                )}>
                                                                <div>
                                                                    {service.etd !== '' &&
                                                                        `Perkiraan Waktu ${service.etd} hari`}
                                                                </div>
                                                                <div>Rp {service.cost}</div>
                                                            </div>
                                                        </div>
                                                    )}
                                                </Listbox.Option>
                                            ))}
                                        </Listbox.Options>
                                    </Transition>
                                </div>
                            </>
                        )}
                    </Listbox>
                ) : null}
            </div>
        </div>
    );
}
