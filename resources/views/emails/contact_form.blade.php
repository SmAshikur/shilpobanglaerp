<x-mail::message>
# New Contact Message

You have received a new inquiry from your website contact form.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Subject:** {{ $data['subject'] ?? 'N/A' }}

**Message:**  
{{ $data['message'] }}

Thanks,  
{{ config('app.name') }}
</x-mail::message>
